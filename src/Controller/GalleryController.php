<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GalleryController extends AbstractController
{
    public function __construct(
        private GalleryRepository $galleryRepository,
        private SerializerInterface $serializer
    ){
    }

    #[Route('api/gallery', name: 'gallery', methods: ['GET'])]
    public function getAllGallery(): JsonResponse
    {
        $gallery = $this->galleryRepository->findBy([], ['id' => 'ASC'], 4);
        $jsonGallery = $this->serializer->serialize($gallery, 'json');
        return new JsonResponse($jsonGallery, Response::HTTP_OK, [], true);
    }
}
