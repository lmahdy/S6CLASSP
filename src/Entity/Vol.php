<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $villeDestination = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeDépart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDArrivée = null;

    #[ORM\ManyToOne(targetEntity: Aeroport::class, inversedBy: 'vols')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aeroport $aeroport = null; // New property for the relation

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDestination(): ?string
    {
        return $this->villeDestination;
    }

    public function setVilleDestination(?string $villeDestination): static
    {
        $this->villeDestination = $villeDestination;

        return $this;
    }

    public function getDateDeDépart(): ?\DateTimeInterface
    {
        return $this->dateDeDépart;
    }

    public function setDateDeDépart(?\DateTimeInterface $dateDeDépart): static
    {
        $this->dateDeDépart = $dateDeDépart;

        return $this;
    }

    public function getDateDArrivée(): ?\DateTimeInterface
    {
        return $this->dateDArrivée;
    }

    public function setDateDArrivée(?\DateTimeInterface $dateDArrivée): static
    {
        $this->dateDArrivée = $dateDArrivée;

        return $this;
    }

    public function getAeroport(): ?Aeroport
    {
        return $this->aeroport;
    }

    public function setAeroport(?Aeroport $aeroport): static
    {
        $this->aeroport = $aeroport;

        return $this;
    }
}
