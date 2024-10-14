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
    private ?\DateTimeInterface $dateDeDepart = null; // Updated field name

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDArrivee = null; // Updated field name

    #[ORM\ManyToOne(targetEntity: Aeroport::class, inversedBy: 'vols')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aeroport $aeroport = null;

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

    public function getDateDeDepart(): ?\DateTimeInterface // Updated getter
    {
        return $this->dateDeDepart;
    }

    public function setDateDeDepart(?\DateTimeInterface $dateDeDepart): static // Updated setter
    {
        $this->dateDeDepart = $dateDeDepart;

        return $this;
    }

    public function getDateDArrivee(): ?\DateTimeInterface // Updated getter
    {
        return $this->dateDArrivee;
    }

    public function setDateDArrivee(?\DateTimeInterface $dateDArrivee): static // Updated setter
    {
        $this->dateDArrivee = $dateDArrivee;

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
