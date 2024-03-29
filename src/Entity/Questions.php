<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column]
    private ?int $enjeu_efc = null;

    #[ORM\Column]
    private ?int $enjeu_eit = null;

    #[ORM\Column]
    private ?int $enjeu_ec = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getEnjeuEfc(): ?int
    {
        return $this->enjeu_efc;
    }

    public function setEnjeuEfc(int $enjeu_efc): self
    {
        $this->enjeu_efc = $enjeu_efc;

        return $this;
    }

    public function getEnjeuEit(): ?int
    {
        return $this->enjeu_eit;
    }

    public function setEnjeuEit(int $enjeu_eit): self
    {
        $this->enjeu_eit = $enjeu_eit;

        return $this;
    }

    public function getEnjeuEc(): ?int
    {
        return $this->enjeu_ec;
    }

    public function setEnjeuEc(int $enjeu_ec): self
    {
        $this->enjeu_ec = $enjeu_ec;

        return $this;
    }

}
