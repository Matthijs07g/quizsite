<?php

namespace App\Entity;

use App\Repository\FinaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FinaleRepository::class)]
class Finale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $thema = null;

    #[ORM\Column(length: 255)]
    private ?string $kenmerk1 = null;

    #[ORM\Column(length: 255)]
    private ?string $kenmerk2 = null;

    #[ORM\Column(length: 255)]
    private ?string $kenmerk3 = null;

    #[ORM\Column(length: 255)]
    private ?string $kenmerk4 = null;

    #[ORM\Column(length: 255)]
    private ?string $kenmerk5 = null;

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

    public function getKenmerk1(): ?string
    {
        return $this->kenmerk1;
    }

    public function setKenmerk1(string $kenmerk1): static
    {
        $this->kenmerk1 = $kenmerk1;

        return $this;
    }

    public function getKenmerk2(): ?string
    {
        return $this->kenmerk2;
    }

    public function setKenmerk2(string $kenmerk2): static
    {
        $this->kenmerk2 = $kenmerk2;

        return $this;
    }

    public function getKenmerk3(): ?string
    {
        return $this->kenmerk3;
    }

    public function setKenmerk3(string $kenmerk3): static
    {
        $this->kenmerk3 = $kenmerk3;

        return $this;
    }

    public function getKenmerk4(): ?string
    {
        return $this->kenmerk4;
    }

    public function setKenmerk4(string $kenmerk4): static
    {
        $this->kenmerk4 = $kenmerk4;

        return $this;
    }

    public function getKenmerk5(): ?string
    {
        return $this->kenmerk5;
    }

    public function setKenmerk5(string $kenmerk5): static
    {
        $this->kenmerk5 = $kenmerk5;

        return $this;
    }
}
