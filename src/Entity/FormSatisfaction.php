<?php

namespace App\Entity;

use App\Repository\FormSatisfactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormSatisfactionRepository::class)]
class FormSatisfaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $sentAt = null;


    #[ORM\ManyToOne(inversedBy: 'formSatisfactions')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $client = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $avis = null;

    #[ORM\ManyToOne(inversedBy: 'formSatisfactions')]
    private ?Car $voitures = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSentAt(): ?\DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeImmutable $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(string $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getVoitures(): ?Car
    {
        return $this->voitures;
    }

    public function setVoitures(?Car $voitures): self
    {
        $this->voitures = $voitures;

        return $this;
    }
}
