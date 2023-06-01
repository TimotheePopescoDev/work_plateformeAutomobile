<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    private ?string $immatriculation = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\Column]
    private ?bool $etat = true;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marques $marques = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Energy $energies = null;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Essais::class)]
    private Collection $essais;

    #[ORM\OneToMany(mappedBy: 'choix01', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'choix02', targetEntity: User::class)]
    private Collection $users02;

    #[ORM\OneToMany(mappedBy: 'choix03', targetEntity: User::class)]
    private Collection $users03;

    #[ORM\OneToMany(mappedBy: 'voitures', targetEntity: FormSatisfaction::class)]
    private Collection $formSatisfactions;

    public function __construct()
    {
        $this->essais = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->users02 = new ArrayCollection();
        $this->users03 = new ArrayCollection();
        $this->formSatisfactions = new ArrayCollection();
    }

    public function __toString(){
        return $this->getModele() . ' - '. $this->getImmatriculation();
    }
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

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

    public function getMarques(): ?Marques
    {
        return $this->marques;
    }

    public function setMarques(?Marques $marques): self
    {
        $this->marques = $marques;

        return $this;
    }

    public function getEnergies(): ?Energy
    {
        return $this->energies;
    }

    public function setEnergies(?Energy $energies): self
    {
        $this->energies = $energies;

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
            $essai->setVoiture($this);
        }

        return $this;
    }

    public function removeEssai(Essais $essai): self
    {
        if ($this->essais->removeElement($essai)) {
            // set the owning side to null (unless already changed)
            if ($essai->getVoiture() === $this) {
                $essai->setVoiture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setChoix01($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getChoix01() === $this) {
                $user->setChoix01(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers02(): Collection
    {
        return $this->users02;
    }

    public function addUsers02(User $users02): self
    {
        if (!$this->users02->contains($users02)) {
            $this->users02->add($users02);
            $users02->setChoix02($this);
        }

        return $this;
    }

    public function removeUsers02(User $users02): self
    {
        if ($this->users02->removeElement($users02)) {
            // set the owning side to null (unless already changed)
            if ($users02->getChoix02() === $this) {
                $users02->setChoix02(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers03(): Collection
    {
        return $this->users03;
    }

    public function addUsers03(User $users03): self
    {
        if (!$this->users03->contains($users03)) {
            $this->users03->add($users03);
            $users03->setChoix03($this);
        }

        return $this;
    }

    public function removeUsers03(User $users03): self
    {
        if ($this->users03->removeElement($users03)) {
            // set the owning side to null (unless already changed)
            if ($users03->getChoix03() === $this) {
                $users03->setChoix03(null);
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
            $formSatisfaction->setVoitures($this);
        }

        return $this;
    }

    public function removeFormSatisfaction(FormSatisfaction $formSatisfaction): self
    {
        if ($this->formSatisfactions->removeElement($formSatisfaction)) {
            // set the owning side to null (unless already changed)
            if ($formSatisfaction->getVoitures() === $this) {
                $formSatisfaction->setVoitures(null);
            }
        }

        return $this;
    }
}
