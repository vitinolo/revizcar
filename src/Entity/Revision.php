<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RevisionRepository;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: RevisionRepository::class)]
class Revision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $datereviz = null;

    #[ORM\Column(length: 20)]
    private ?string $kilometrage = null;

    #[ORM\Column(length: 200)]
    private ?string $filtre = null;

    #[ORM\Column(length: 40)]
    private ?string $huile = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default'=>'CURRENT_TIMESTAMP'])]
    #[Gedmo\Timestampable(on:'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'revisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $cars = null;

    public function __toString(){
        return $this->datereviz;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatereviz(): ?string
    {
        return $this->datereviz;
    }

    public function setDatereviz(string $datereviz): static
    {
        $this->datereviz = $datereviz;

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

    public function getFiltre(): ?string
    {
        return $this->filtre;
    }

    public function setFiltre(string $filtre): static
    {
        $this->filtre = $filtre;

        return $this;
    }

    public function getHuile(): ?string
    {
        return $this->huile;
    }

    public function setHuile(string $huile): static
    {
        $this->huile = $huile;

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

    public function getCars(): ?car
    {
        return $this->cars;
    }

    public function setCars(?car $cars): static
    {
        $this->cars = $cars;

        return $this;
    }
}
