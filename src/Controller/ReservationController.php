<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ConfigurationRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ReservationController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private OpeningHoursRepository $openingHoursRepository,
        private ReservationRepository $reservationRepository,
        private ConfigurationRepository $configurationRepository,
        private EntityManagerInterface $entityManager
    ){
    }

    #[Route('api/reservation/gethours/{date}/{nbGuest}', name: 'app_reservation', methods: 'GET')]
    public function getValidHours(string $date, int $nbGuest): Response
    {
        // Récupération des horaires d'ouverture
        $date = new \DateTime($date.' 00:00:00');
        $openingHours = $this->openingHoursRepository->findByDay((int) $date->format('N'));

        $lunchOpening = $openingHours->getLunchOpening();
        $lunchClosing = $openingHours->getLunchClosing();
        $dinnerOpening = $openingHours->getDinnerOpening();
        $dinnerClosing = $openingHours->getDinnerClosing();

        // Soustraction d'1 heure sur les horaires de fermeture (midi et soir)
        if (!is_null($openingHours->getLunchOpening())) {
            $lunchClosing->modify("-60 minutes");
        }
        if (!is_null($openingHours->getDinnerOpening())) {
            $dinnerClosing->modify("-60 minutes");
        }

        // Création de tranches horaires de 15 minutes
        $timeSlots = [];
        if (!is_null($lunchOpening)) {
            $hour = $lunchOpening;
            while ($hour <= $lunchClosing) {
                $elementHour = new \DateTime();
                $elementHour->setTimestamp((int) $hour->getTimestamp());
                $timeSlots['lunch'][] = $elementHour;
                $hour->modify("+15 minutes");
            }
        }

        if (!is_null($dinnerOpening)) {
            $hour = $dinnerOpening;
            while ($hour <= $dinnerClosing) {
                $elementHour = new \DateTime();
                $elementHour->setTimestamp((int) $hour->getTimestamp());
                $timeSlots['dinner'][] = $elementHour;
                $hour->modify("+15 minutes");
            }
        }

        // Vérification du nombre maximum de réservations par tranches horaires de 15 mns
        $maxGuest = $this->configurationRepository->findOneBy(['name' => 'Nombre total de places dans le restaurant'])->getValue();
        $result = [];
        foreach ($timeSlots as $key => $timeSlot) {

            foreach ($timeSlot as $slot) {
                $slot->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
                $nbReservation = $this->reservationRepository->findByTimeSlot($slot);
                $nbReservation = empty($nbReservation) ? 0 : $nbReservation[1];

                if($nbReservation + $nbGuest <= $maxGuest) {
                    $result[$key][] = $slot;
                }
            }
        }

        $jsonOpeningHours = $this->serializer->serialize($result, 'json');
        return new JsonResponse($jsonOpeningHours, Response::HTTP_OK, [], true);
    }

    #[Route('api/reservation', name: 'create_reservation', methods: 'POST')]
    public function createReservation(Request $request): JsonResponse
    {
        $reservation = $this->serializer->deserialize($request->getContent(), Reservation::class,'json');
        $departure = new \DateTime();
        $departure->setTimestamp((int) $reservation->getArrival()->getTimestamp());
        $departure->modify('+90 minutes');
        $reservation->setDeparture($departure);

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        $response = $this->serializer->serialize($reservation, 'json');
        return new JsonResponse($response, Response::HTTP_OK, [], true);
    }
}
