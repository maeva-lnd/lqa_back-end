<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ContactController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private EntityManagerInterface $entityManager
    ){
    }

    #[Route('api/contact', name: 'contact', methods: ['POST'])]
    public function createContactMessage(Request $request): JsonResponse
    {
        $contactMessage = $this->serializer->deserialize($request->getContent(), Contact::class,'json');

        $this->entityManager->persist($contactMessage);
        $this->entityManager->flush();
        $jsonContact = $this->serializer->serialize($contactMessage, 'json');

        return new JsonResponse($jsonContact, Response::HTTP_OK, [], true);
    }
}

