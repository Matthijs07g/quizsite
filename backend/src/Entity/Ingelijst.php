<?php

namespace App\Entity;

use App\Repository\IngelijstRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngelijstRepository::class)]
class Ingelijst
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $thema = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord1 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord2 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord3 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord4 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord5 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord6 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord7 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord8 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord9 = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord10 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThema(): ?string
    {
        return $this->thema;
    }

    public function setThema(string $thema): static
    {
        $this->thema = $thema;

        return $this;
    }

    public function getAntwoord1(): ?string
    {
        return $this->antwoord1;
    }

    public function setAntwoord1(string $antwoord1): static
    {
        $this->antwoord1 = $antwoord1;

        return $this;
    }

    public function getAntwoord2(): ?string
    {
        return $this->antwoord2;
    }

    public function setAntwoord2(string $antwoord2): static
    {
        $this->antwoord2 = $antwoord2;

        return $this;
    }

    public function getAntwoord3(): ?string
    {
        return $this->antwoord3;
    }

    public function setAntwoord3(string $antwoord3): static
    {
        $this->antwoord3 = $antwoord3;

        return $this;
    }

    public function getAntwoord4(): ?string
    {
        return $this->antwoord4;
    }

    public function setAntwoord4(string $antwoord4): static
    {
        $this->antwoord4 = $antwoord4;

        return $this;
    }

    public function getAntwoord5(): ?string
    {
        return $this->antwoord5;
    }

    public function setAntwoord5(string $antwoord5): static
    {
        $this->antwoord5 = $antwoord5;

        return $this;
    }

    public function getAntwoord6(): ?string
    {
        return $this->antwoord6;
    }

    public function setAntwoord6(string $antwoord6): static
    {
        $this->antwoord6 = $antwoord6;

        return $this;
    }

    public function getAntwoord7(): ?string
    {
        return $this->antwoord7;
    }

    public function setAntwoord7(string $antwoord7): static
    {
        $this->antwoord7 = $antwoord7;

        return $this;
    }

    public function getAntwoord8(): ?string
    {
        return $this->antwoord8;
    }

    public function setAntwoord8(string $antwoord8): static
    {
        $this->antwoord8 = $antwoord8;

        return $this;
    }

    public function getAntwoord9(): ?string
    {
        return $this->antwoord9;
    }

    public function setAntwoord9(string $antwoord9): static
    {
        $this->antwoord9 = $antwoord9;

        return $this;
    }

    public function getAntwoord10(): ?string
    {
        return $this->antwoord10;
    }

    public function setAntwoord10(string $antwoord10): static
    {
        $this->antwoord10 = $antwoord10;

        return $this;
    }
}
