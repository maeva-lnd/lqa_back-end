<?php

namespace App\Entity;

use App\Repository\DishesCardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DishesCardRepository::class)]
class DishesCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getDishesCard", "getCardCategory"])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'getDishesCard')]
    #[Groups(["getCardCategory"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?CardCategory $category = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getDishesCard", "getCardCategory"])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(["getDishesCard", "getCardCategory"])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(["getDishesCard", "getCardCategory"])]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?CardCategory
    {
        return $this->category;
    }

    public function setCategory(?CardCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
