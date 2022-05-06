<?php

namespace App\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('atelier:read')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('atelier:read')]
    private $libelle;

    #[ORM\Column(type: 'date')]
    #[Groups('atelier:read')]
    private $date;

    #[ORM\Column(type: 'string')]
    #[Groups('atelier:read')]
    private $heureDebut;

    #[ORM\Column(type: 'string')]
    #[Groups('atelier:read')]
    private $heureFin;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('atelier:read')]
    private $statut;

    #[ORM\OneToMany(mappedBy: 'ateliers', targetEntity: Planning::class)]
    #[Groups('atelier:read')]
    private $plannings;

    #[ORM\ManyToOne(targetEntity: Animateur::class, inversedBy: 'ateliers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('atelier:read')]
    private $animateurs;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('atelier:read')]
    private $image;

    public function __construct()
    {
        $this->plannings = new ArrayCollection();
    }

    
    public function __toString()
    {
        return $this->getLibelle()." - ".$this->getDate()->format('d/m/Y')." De ". $this->getHeureDebut() ." À ".$this->getHeureFin();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDebut(): ?string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(string $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?string
    {
        return $this->heureFin;
    }

    public function setHeureFin(string $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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
            $planning->setAteliers($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getAteliers() === $this) {
                $planning->setAteliers(null);
            }
        }

        return $this;
    }

    public function getAnimateurs(): ?Animateur
    {
        return $this->animateurs;
    }

    public function setAnimateurs(?Animateur $animateurs): self
    {
        $this->animateurs = $animateurs;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
