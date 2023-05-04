<?php

namespace App\Entity;

use App\Repository\MenuCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuCategoryRepository::class)]
class MenuCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: DishesMenu::class)]
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


    public function getDishesMenus(): Collection
    {
        return $this->dishesMenus;
    }

    public function addDishesMenu(DishesMenu $dishesMenu): self
    {
        if (!$this->dishesMenus->contains($dishesMenu)) {
            $this->dishesMenus->add($dishesMenu);
            $dishesMenu->setCategory($this);
        }

        return $this;
    }

    public function removeDishesMenu(DishesMenu $dishesMenu): self
    {
        if ($this->dishesMenus->removeElement($dishesMenu)) {
            // set the owning side to null (unless already changed)
            if ($dishesMenu->getCategory() === $this) {
                $dishesMenu->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
