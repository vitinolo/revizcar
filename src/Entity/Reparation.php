<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\ReparationRepository;

#[ORM\Entity(repositoryClass: ReparationRepository::class)]
class Reparation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nature = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $prix = null;

    #[ORM\Column(length: 20)]
    private ?string $daterep = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default'=>'CURRENT_TIMESTAMP'])]
    #[Gedmo\Timestampable(on:'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'reparations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $Cars = null;

    #[ORM\Column(length: 255)]
    private ?string $kilometrage = null;

    public function __toString(){
        return $this->daterep;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): static
    {
        $this->nature = $nature;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDaterep(): ?string
    {
        return $this->daterep;
    }

    public function setDaterep(string $daterep): static
    {
        $this->daterep = $daterep;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /* public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    } */

    
    public function getCars(): ?Car
    {
        return $this->Cars;
    }

    public function setCars(?Car $Cars): static
    {
        $this->Cars = $Cars;

        return $this;
    }

    public function getKilometrage(): ?string
    {
        return $this->kilometrage;
    }

    public function setKilometrage(string $kilometrage): static
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }
}
