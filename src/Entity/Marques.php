<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquesRepository::class)]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marques = null;

    #[ORM\OneToMany(mappedBy: 'marques', targetEntity: Car::class)]
    private Collection $cars;

    #[ORM\OneToMany(mappedBy: 'marques', targetEntity: Essais::class)]
    private Collection $essais;

    #[ORM\OneToMany(mappedBy: 'marques', targetEntity: FormSatisfaction::class)]
    private Collection $formSatisfactions;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->essais = new ArrayCollection();
        $this->formSatisfactions = new ArrayCollection();
    }

    public function __toString(){
        return $this->getMarques();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarques(): ?string
    {
        return $this->marques;
    }

    public function setMarques(string $marques): self
    {
        $this->marques = $marques;

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setMarques($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getMarques() === $this) {
                $car->setMarques(null);
            }
        }

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
            $essai->setMarques($this);
        }

        return $this;
    }

    public function removeEssai(Essais $essai): self
    {
        if ($this->essais->removeElement($essai)) {
            // set the owning side to null (unless already changed)
            if ($essai->getMarques() === $this) {
                $essai->setMarques(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormSatisfaction>
     */
    public function getFormSatisfactions(): Collection
    {
        return $this->formSatisfactions;
    }

    public function addFormSatisfaction(FormSatisfaction $formSatisfaction): self
    {
        if (!$this->formSatisfactions->contains($formSatisfaction)) {
            $this->formSatisfactions->add($formSatisfaction);
            $formSatisfaction->setMarques($this);
        }

        return $this;
    }

    public function removeFormSatisfaction(FormSatisfaction $formSatisfaction): self
    {
        if ($this->formSatisfactions->removeElement($formSatisfaction)) {
            // set the owning side to null (unless already changed)
            if ($formSatisfaction->getMarques() === $this) {
                $formSatisfaction->setMarques(null);
            }
        }

        return $this;
    }
}
