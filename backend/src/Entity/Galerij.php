<?php

namespace App\Entity;

use App\Repository\GalerijRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalerijRepository::class)]
class Galerij
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $thema = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding1 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding2 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding3 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding4 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding5 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding6 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding7 = null;

    #[ORM\Column(length: 255)]
    private ?string $afbeelding8 = null;

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

    public function getAfbeelding1(): ?string
    {
        return $this->afbeelding1;
    }

    public function setAfbeelding1(string $afbeelding1): static
    {
        $this->afbeelding1 = $afbeelding1;

        return $this;
    }

    public function getAfbeelding2(): ?string
    {
        return $this->afbeelding2;
    }

    public function setAfbeelding2(string $afbeelding2): static
    {
        $this->afbeelding2 = $afbeelding2;

        return $this;
    }

    public function getAfbeelding3(): ?string
    {
        return $this->afbeelding3;
    }

    public function setAfbeelding3(string $afbeelding3): static
    {
        $this->afbeelding3 = $afbeelding3;

        return $this;
    }

    public function getAfbeelding4(): ?string
    {
        return $this->afbeelding4;
    }

    public function setAfbeelding4(string $afbeelding4): static
    {
        $this->afbeelding4 = $afbeelding4;

        return $this;
    }

    public function getAfbeelding5(): ?string
    {
        return $this->afbeelding5;
    }

    public function setAfbeelding5(string $afbeelding5): static
    {
        $this->afbeelding5 = $afbeelding5;

        return $this;
    }

    public function getAfbeelding6(): ?string
    {
        return $this->afbeelding6;
    }

    public function setAfbeelding6(string $afbeelding6): static
    {
        $this->afbeelding6 = $afbeelding6;

        return $this;
    }

    public function getAfbeelding7(): ?string
    {
        return $this->afbeelding7;
    }

    public function setAfbeelding7(string $afbeelding7): static
    {
        $this->afbeelding7 = $afbeelding7;

        return $this;
    }

    public function getAfbeelding8(): ?string
    {
        return $this->afbeelding8;
    }

    public function setAfbeelding8(string $afbeelding8): static
    {
        $this->afbeelding8 = $afbeelding8;

        return $this;
    }
}
