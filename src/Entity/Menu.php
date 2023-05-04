<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: DishesMenu::class)]
    private Collection $dishesMenus;

    public function __construct()
    {
        $this->dishesMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDishesMenus(): Collection
    {
        return $this->dishesMenus;
    }

    public function addDishesMenu(DishesMenu $dishesMenu): self
    {
        if (!$this->dishesMenus->contains($dishesMenu)) {
            $this->dishesMenus->add($dishesMenu);
            $dishesMenu->setMenu($this);
        }

        return $this;
    }

    public function removeDishesMenu(DishesMenu $dishesMenu): self
    {
        if ($this->dishesMenus->removeElement($dishesMenu)) {
            // set the owning side to null (unless already changed)
            if ($dishesMenu->getMenu() === $this) {
                $dishesMenu->setMenu(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
