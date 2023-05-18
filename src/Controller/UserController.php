<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    public function __construct(
        private Security $security,
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
        private SerializerInterface $serializer

    ){
    }

    #[Route('/api/user', name: 'app_user', methods: ['GET'])]
    public function index(): Response
    {
        $user= $this->security->getUser();
        $jsonUser = $this->serializer->serialize($user, 'json');
        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }

    #[Route('/api/user', name: 'app_create_user', methods: ['POST'])]
    public function createAccount(Request $request): JsonResponse
    {
        // Récupération des paramètres pour créer un objet user
        $user = $this->serializer->deserialize($request->getContent(), User::class,'json');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
        $user->setRoles(["ROLE_USER"]);
        $user->setDefaultGuestNumber((int) $user->getDefaultGuestNumber());
        // Enregistrement en base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $jsonUser = $this->serializer->serialize($user, 'json');

        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }

    #[Route('/api/useradmin', name: 'app_create_admin', methods: ['POST'])]
    public function createAdmin(Request $request): JsonResponse
    {
        // Récupération des paramètres pour créer un objet user
        $user = $this->serializer->deserialize($request->getContent(), User::class,'json');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
        $user->setRoles(["ROLE_USER","ROLE_ADMIN"]);
        // Enregistrement en base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $jsonUser = $this->serializer->serialize($user, 'json');

        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }

}
