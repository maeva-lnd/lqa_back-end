<?php

namespace App\Controller;

use App\Repository\CardCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CardAndMenuController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializer,
        private CardCategoryRepository $cardCategoryRepository
    ){
    }

    #[Route('api/card', name: 'card_restaurant', methods: 'GET')]
    public function getAllDishesCard(): JsonResponse
    {
        $dishesCard = $this->cardCategoryRepository->findAll();
        $jsonDishesCard = $this->serializer->serialize($dishesCard, 'json', ['groups' => 'getDishesCard']);
        return new JsonResponse($jsonDishesCard, Response::HTTP_OK, [], true);
    }


}
