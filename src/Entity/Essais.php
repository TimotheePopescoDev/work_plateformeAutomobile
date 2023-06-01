<?php

namespace App\Entity;

use App\Repository\EssaisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EssaisRepository::class)]
class Essais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column]
    private ?bool $etat = true ;

    #[ORM\ManyToOne(inversedBy: 'essais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $conducteur = null;

    #[ORM\ManyToOne(inversedBy: 'essais')]
    private ?User $passager01 = null;

    #[ORM\ManyToOne(inversedBy: 'essais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $voiture = null;


    #[ORM\ManyToOne(inversedBy: 'essais')]
    private ?Parcours $route = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getConducteur(): ?User
    {
        return $this->conducteur;
    }

    public function setConducteur(?User $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function getPassager01(): ?user
    {
        return $this->passager01;
    }

    public function setPassager01(?user $passager01): self
    {
        $this->passager01 = $passager01;

        return $this;
    }

    public function getVoiture(): ?Car
    {
        return $this->voiture;
    }

    public function setVoiture(?Car $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getRoute(): ?Parcours
    {
        return $this->route;
    }

    public function setRoute(?Parcours $route): self
    {
        $this->route = $route;

        return $this;
    }
}
