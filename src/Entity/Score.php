<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[ORM\Column(nullable: true)]
    private ?float $efc = null;

    #[ORM\Column]
    private ?float $eit = null;

    #[ORM\Column]
    private ?float $ec = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;




    public function getId(): ?int
    {
        return $this->id;
    }




    public function getEfc(): ?float
    {
        return $this->efc;
    }

    public function setEfc(?float $efc): self
    {
        $this->efc = $efc;

        return $this;
    }

    public function getEit(): ?float
    {
        return $this->eit;
    }

    public function setEit(float $eit): self
    {
        $this->eit = $eit;

        return $this;
    }

    public function getEc(): ?float
    {
        return $this->ec;
    }

    public function setEc(float $ec): self
    {
        $this->ec = $ec;

        return $this;
    }

    public function getTotal(): ?float
    {
    
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

  
}
