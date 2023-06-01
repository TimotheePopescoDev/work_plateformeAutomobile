<?php

namespace App\Entity;

use App\Repository\EnergyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnergyRepository::class)]
class Energy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $energies = null;

    #[ORM\OneToMany(mappedBy: 'energies', targetEntity: Car::class)]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }
    public function __toString(){
        return $this->getEnergies();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnergies(): ?string
    {
        return $this->energies;
    }

    public function setEnergies(string $energies): self
    {
        $this->energies = $energies;

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
            $car->setEnergies($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getEnergies() === $this) {
                $car->setEnergies(null);
            }
        }

        return $this;
    }
}
