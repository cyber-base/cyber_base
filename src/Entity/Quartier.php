<?php

namespace App\Entity;

use App\Repository\QuartierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuartierRepository::class)]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomQuartier;

    #[ORM\OneToMany(mappedBy: 'quartiers', targetEntity: Usager::class)]
    private $usagers;

    public function __construct()
    {
        $this->usagers = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNomQuartier();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomQuartier(): ?string
    {
        return $this->nomQuartier;
    }

    public function setNomQuartier(string $nomQuartier): self
    {
        $this->nomQuartier = $nomQuartier;

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
            $usager->setQuartiers($this);
        }

        return $this;
    }

    public function removeUsager(Usager $usager): self
    {
        if ($this->usagers->removeElement($usager)) {
            // set the owning side to null (unless already changed)
            if ($usager->getQuartiers() === $this) {
                $usager->setQuartiers(null);
            }
        }

        return $this;
    }
}
