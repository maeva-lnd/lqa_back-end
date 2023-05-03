<?php

namespace App\Entity;

use App\Repository\DayLabelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DayLabelRepository::class)]
class DayLabel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getOpeningHours", "getDay"])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getOpeningHours", "getDay"])]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'day', cascade: ['persist', 'remove'])]
    #[Groups(["getOpeningHours"])]
    private ?OpeningHours $openingHours = null;

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

    public function getOpeningHours(): ?OpeningHours
    {
        return $this->openingHours;
    }

    public function setOpeningHours(OpeningHours $openingHours): self
    {
        if ($openingHours->getDay() !== $this) {
            $openingHours->setDay($this);
        }

        $this->openingHours = $openingHours;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
