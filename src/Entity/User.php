<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permisrecto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permisverso = null;

    #[ORM\Column]
    private ?bool $etat = true;

    #[ORM\OneToMany(mappedBy: 'conducteur', targetEntity: Essais::class)]
    private Collection $essais;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: FormSatisfaction::class)]
    private Collection $formSatisfactions;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Car $choix01 = null;

    #[ORM\ManyToOne(inversedBy: 'users02')]
    private ?Car $choix02 = null;

    #[ORM\ManyToOne(inversedBy: 'users03')]
    private ?Car $choix03 = null;

    #[ORM\Column]
    private ?bool $avis = true;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $decharge = null;

    public function __construct()
    {
        $this->essais = new ArrayCollection();
        $this->formSatisfactions = new ArrayCollection();
    }
    public function __toString(){
        return $this->getId(). ' - ' .$this->getNom() . ' '.$this->getPrenom();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPermisrecto(): ?string
    {
        return $this->permisrecto;
    }

    public function setPermisrecto(?string $permisrecto): self
    {
        $this->permisrecto = $permisrecto;

        return $this;
    }

    public function getPermisverso(): ?string
    {
        return $this->permisverso;
    }

    public function setPermisverso(?string $permisverso): self
    {
        $this->permisverso = $permisverso;

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
            $essai->setConducteur($this);
        }

        return $this;
    }

    public function removeEssai(Essais $essai): self
    {
        if ($this->essais->removeElement($essai)) {
            // set the owning side to null (unless already changed)
            if ($essai->getConducteur() === $this) {
                $essai->setConducteur(null);
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
            $formSatisfaction->setUser($this);
        }

        return $this;
    }

    public function removeFormSatisfaction(FormSatisfaction $formSatisfaction): self
    {
        if ($this->formSatisfactions->removeElement($formSatisfaction)) {
            // set the owning side to null (unless already changed)
            if ($formSatisfaction->getUser() === $this) {
                $formSatisfaction->setUser(null);
            }
        }

        return $this;
    }

    public function getChoix01(): ?Car
    {
        return $this->choix01;
    }

    public function setChoix01(?Car $choix01): self
    {
        $this->choix01 = $choix01;

        return $this;
    }

    public function getChoix02(): ?Car
    {
        return $this->choix02;
    }

    public function setChoix02(?Car $choix02): self
    {
        $this->choix02 = $choix02;

        return $this;
    }

    public function getChoix03(): ?Car
    {
        return $this->choix03;
    }

    public function setChoix03(?Car $choix03): self
    {
        $this->choix03 = $choix03;

        return $this;
    }

    public function isAvis(): ?bool
    {
        return $this->avis;
    }

    public function setAvis(bool $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getDecharge(): ?string
    {
        return $this->decharge;
    }

    public function setDecharge(?string $decharge): self
    {
        $this->decharge = $decharge;

        return $this;
    }
}
