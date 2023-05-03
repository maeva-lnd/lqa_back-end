<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getOpeningHours", "getDay"])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'openingHours', cascade: ['persist', 'remove'])]
    #[Groups(["getDay"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?DayLabel $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Groups(["getOpeningHours", "getDay"])]
    private ?\DateTimeInterface $lunch_opening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Groups(["getOpeningHours", "getDay"])]
    private ?\DateTimeInterface $lunch_closing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Groups(["getOpeningHours", "getDay"])]
    private ?\DateTimeInterface $dinner_opening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Groups(["getOpeningHours", "getDay"])]
    private ?\DateTimeInterface $dinner_closing = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?DayLabel
    {
        return $this->day;
    }

    public function setDay(DayLabel $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getLunchOpening(): ?\DateTimeInterface
    {
        return $this->lunch_opening;
    }

    public function setLunchOpening(?\DateTimeInterface $lunch_opening): self
    {
        $this->lunch_opening = $lunch_opening;

        return $this;
    }

    public function getLunchClosing(): ?\DateTimeInterface
    {
        return $this->lunch_closing;
    }

    public function setLunchClosing(?\DateTimeInterface $lunch_closing): self
    {
        $this->lunch_closing = $lunch_closing;

        return $this;
    }

    public function getDinnerOpening(): ?\DateTimeInterface
    {
        return $this->dinner_opening;
    }

    public function setDinnerOpening(?\DateTimeInterface $dinner_opening): self
    {
        $this->dinner_opening = $dinner_opening;

        return $this;
    }

    public function getDinnerClosing(): ?\DateTimeInterface
    {
        return $this->dinner_closing;
    }

    public function setDinnerClosing(?\DateTimeInterface $dinner_closing): self
    {
        $this->dinner_closing = $dinner_closing;

        return $this;
    }
}
