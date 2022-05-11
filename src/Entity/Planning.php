<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(name:'created', type: 'datetime', options:["default"=>"CURRENT_TIMESTAMP"])]
    private $date =  'CURRENT_TIMESTAMP';

    #[ORM\ManyToOne(targetEntity: Usager::class, inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private $usagers;

    #[ORM\ManyToOne(targetEntity: Poste::class, inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private $postes;

    #[ORM\ManyToOne(targetEntity: Atelier::class, inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private $ateliers;

    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->date = new \Datetime();
    }

    public function __toString()
    {
        return $this->usagers;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsagers(): ?Usager
    {
        return $this->usagers;
    }

    public function setUsagers(?Usager $usagers): self
    {
        $this->usagers = $usagers;

        return $this;
    }

    public function getPostes(): ?Poste
    {
        return $this->postes;
    }

    public function setPostes(?Poste $postes): self
    {
        $this->postes = $postes;

        return $this;
    }

    public function getAteliers(): ?Atelier
    {
        return $this->ateliers;
    }

    public function setAteliers(?Atelier $ateliers): self
    {
        $this->ateliers = $ateliers;

        return $this;
    }
}
