<?php

namespace App\Entity;

use App\Repository\PartenaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartenaireRepository::class)]
class Partenaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nomEtablissement;

    #[ORM\Column(type: 'string', length: 100)]
    private $typeEtablissement;

    #[ORM\OneToMany(mappedBy: 'partenaires', targetEntity: Usager::class)]
    private $usagers;

    public function __construct()
    {
        $this->usagers = new ArrayCollection();
    }

    
    public function __toString()
    {
        return $this->getNomEtablissement();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): self
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getTypeEtablissement(): ?string
    {
        return $this->typeEtablissement;
    }

    public function setTypeEtablissement(string $typeEtablissement): self
    {
        $this->typeEtablissement = $typeEtablissement;

        return $this;
    }

    /**
     * @return Collection<int, Usager>
     */
    public function getUsagers(): Collection
    {
        return $this->usagers;
    }

    public function addUsager(Usager $usager): self
    {
        if (!$this->usagers->contains($usager)) {
            $this->usagers[] = $usager;
            $usager->setPartenaires($this);
        }

        return $this;
    }

    public function removeUsager(Usager $usager): self
    {
        if ($this->usagers->removeElement($usager)) {
            // set the owning side to null (unless already changed)
            if ($usager->getPartenaires() === $this) {
                $usager->setPartenaires(null);
            }
        }

        return $this;
    }
}
