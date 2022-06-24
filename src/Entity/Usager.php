<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsagerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: UsagerRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class Usager extends Personne implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
        #[Groups('usager:read')]
    private $email;

    #[ORM\Column(type: 'json')]
        #[Groups('usager:read')]
    private $roles = ["ROLE_USAGER"];

    #[ORM\Column(type: 'string')]
        #[Groups('usager:read')]
    private $password;

    #[ORM\Column(type: 'string', length: 50)]
        #[Groups('usager:read')]
    private $categorie;

    #[ORM\Column(type: 'string', length: 50)]
        #[Groups('usager:read')]
    private $niveau;

    #[ORM\Column(type: 'string', length: 50)]
        #[Groups('usager:read')]
    private $loisir;

    #[ORM\Column(type: 'string', length: 100)]
        #[Groups('usager:read')]
    private $adresse;

    #[ORM\Column(type: 'string', length: 50)]
        #[Groups('usager:read')]
    private $ville;

    #[ORM\Column(type: 'string', length: 10)]
        #[Groups('usager:read')]
    private $cp;

    #[ORM\ManyToOne(targetEntity: Quartier::class, inversedBy: 'usagers')]
    #[ORM\JoinColumn(nullable: false)]
        #[Groups('usager:read')]
    private $quartiers;

    #[ORM\ManyToOne(targetEntity: Partenaire::class, inversedBy: 'usagers')]
    #[Groups('usager:read')]
    private $partenaires;

    #[ORM\OneToMany(mappedBy: 'usagers', targetEntity: Planning::class)]
    #[Groups('usager:read')]
    private $plannings;

    #[ORM\Column(type: 'string', length: 30)]
    #[Groups('usager:read')]
    private $genre;

    #[ORM\Column(name:'created', type: 'datetime', options:["default"=>"CURRENT_TIMESTAMP"])]
    private $dateCreation =  'CURRENT_TIMESTAMP';


    public function __construct()
    {
        $this->plannings = new ArrayCollection();
        $this->dateCreation = new \Datetime();
    }

    public function __toString()
    {
        return $this->getNom() .' '. $this->getPrenom();
        return $this->getGenre();

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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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
        // $roles[] = 'ROLE_USER';

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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getLoisir(): ?string
    {
        return $this->loisir;
    }

    public function setLoisir(string $loisir): self
    {
        $this->loisir = $loisir;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getQuartiers(): ?Quartier
    {
        return $this->quartiers;
    }

    public function setQuartiers(?Quartier $quartiers): self
    {
        $this->quartiers = $quartiers;

        return $this;
    }

    public function getPartenaires(): ?Partenaire
    {
        return $this->partenaires;
    }

    public function setPartenaires(?Partenaire $partenaires): self
    {
        $this->partenaires = $partenaires;

        return $this;
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->setUsagers($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getUsagers() === $this) {
                $planning->setUsagers(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

 

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

 
   
}
