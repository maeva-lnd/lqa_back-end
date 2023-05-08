<?php

namespace App\Controller;

use App\Entity\DishesMenu;
use App\Entity\Menu;
use App\Entity\MenuCategory;
use App\Repository\CardCategoryRepository;
use App\Repository\DishesMenuRepository;
use App\Repository\MenuCategoryRepository;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CardAndMenuController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializer,
        private CardCategoryRepository $cardCategoryRepository,
        private MenuRepository $menuRepository,
        private MenuCategoryRepository $menuCategoryRepository,
        private DishesMenuRepository $dishesMenuRepository
    ){
    }

    #[Route('api/card', name: 'card_restaurant', methods: 'GET')]
    public function getAllDishesCard(): JsonResponse
    {
        $dishesCard = $this->cardCategoryRepository->findAll();
        $jsonDishesCard = $this->serializer->serialize($dishesCard, 'json', ['groups' => 'getDishesCard']);
        return new JsonResponse($jsonDishesCard, Response::HTTP_OK, [], true);
    }

    #[Route('api/menu', name: 'menu_restaurant', methods: 'GET')]
    public function getAllDishesMenu(): JsonResponse
    {
        $result = [];
        $dishesMenu = $this->menuRepository->findAll();

        foreach ($dishesMenu as $menu) {

            $result[] = $this->createStdMenu($menu);
        }
        $jsonDishesCard = $this->serializer->serialize($result, 'json');
        return new JsonResponse($jsonDishesCard, Response::HTTP_OK, [], true);
    }

    private function createStdMenu(Menu $menu) : \stdClass
    {
        $resultMenu = new \stdClass();
        $resultCategories = [];
        $resultMenu->id = $menu->getId();
        $resultMenu->name = $menu->getName();
        $resultMenu->description = $menu->getDescription();
        $resultMenu->price = $menu->getPrice();


        $categories = $this->menuCategoryRepository->findByMenu($menu);
        foreach ($categories as $category) {
            $resultCategories[] = $this->createStdCategory($menu, $category);
        }
        $resultMenu->categories = $resultCategories;

        return $resultMenu;
    }

    private function createStdCategory(Menu $menu, MenuCategory $category) : \stdClass
    {
        $resultDishes = [];
        $resultCategory = new \stdClass();
        $resultCategory->id = $category->getId();
        $resultCategory->name = $category->getName();

        $dishes = $this->dishesMenuRepository->findBy(['menu' => $menu, 'category' => $category]);
        foreach ($dishes as $dish) {
            $resultDishes[] = $this->createStdDish($dish);
        }
        $resultCategory->dishes = $resultDishes;

        return  $resultCategory;
    }

    private function createStdDish(DishesMenu $dish) : \stdClass
    {
        $resultDish = new \stdClass();
        $resultDish->id = $dish->getId();
        $resultDish->name = $dish->getName();
        $resultDish->description = $dish->getDescription();

        return $resultDish;
    }
}
