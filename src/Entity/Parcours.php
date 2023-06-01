<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 2550)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $dispo = null;

    #[ORM\OneToMany(mappedBy: 'route', targetEntity: Essais::class)]
    private Collection $essais;

    public function __construct()
    {
        $this->essais = new ArrayCollection();
    }
    public function __toString(){
        return $this->getNom();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isDispo(): ?bool
    {
        return $this->dispo;
    }

    public function setDispo(bool $dispo): self
    {
        $this->dispo = $dispo;

        return $this;
    }

    /**
     * @return Collection<int, Essais>
     */
    public function getEssais(): Collection
    {
        return $this->essais;
    }

    public function addEssai(Essais $essai): self
    {
        if (!$this->essais->contains($essai)) {
            $this->essais->add($essai);
            $essai->setRoute($this);
        }

        return $this;
    }

    public function removeEssai(Essais $essai): self
    {
        if ($this->essais->removeElement($essai)) {
            // set the owning side to null (unless already changed)
            if ($essai->getRoute() === $this) {
                $essai->setRoute(null);
            }
        }

        return $this;
    }
}
