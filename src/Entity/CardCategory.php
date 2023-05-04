<?php

namespace App\Entity;

use App\Repository\CardCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardCategoryRepository::class)]
class CardCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getDishesCard", "getCardCategory"])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getDishesCard", "getCardCategory"])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: DishesCard::class)]
    #[Groups(["getDishesCard"])]
    private Collection $dishesCards;

    public function __construct()
    {
        $this->dishesCards = new ArrayCollection();
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


    public function getDishesCards(): Collection
    {
        return $this->dishesCards;
    }

    public function addDishesCard(DishesCard $dishesCard): self
    {
        if (!$this->dishesCards->contains($dishesCard)) {
            $this->dishesCards->add($dishesCard);
            $dishesCard->setCategory($this);
        }

        return $this;
    }

    public function removeDishesCard(DishesCard $dishesCard): self
    {
        if ($this->dishesCards->removeElement($dishesCard)) {
            // set the owning side to null (unless already changed)
            if ($dishesCard->getCategory() === $this) {
                $dishesCard->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
