<?php

namespace App\Controller;

use App\Repository\DayLabelRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OpeningHoursController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private DayLabelRepository $dayLabelRepository
    ){
    }

    #[Route('api/openinghours', name: 'opening_hours', methods: 'GET')]
    public function getAllOpeningHours(): JsonResponse
    {
        $openingHours = $this->dayLabelRepository->findAll();
        $jsonOpeningHours = $this->serializer->serialize($openingHours, 'json', ['groups' => 'getOpeningHours']);
        return new JsonResponse($jsonOpeningHours, Response::HTTP_OK, [], true);
    }
}
