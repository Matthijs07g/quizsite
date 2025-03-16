<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $vraag = null;

    #[ORM\Column(length: 255)]
    private ?string $antwoord = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getvraag(): ?string
    {
        return $this->vraag;
    }

    public function setVraag(string $vraag): static
    {
        $this->vraag = $vraag;

        return $this;
    }

    public function getAntwoord(): ?string
    {
        return $this->antwoord;
    }

    public function setAntwoord(string $antwoord): static
    {
        $this->antwoord = $antwoord;

        return $this;
    }
}
