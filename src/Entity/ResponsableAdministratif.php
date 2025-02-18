<?php

namespace App\Entity;

use App\Repository\ResponsableAdministratifRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ResponsableAdministratifRepository::class)]
class ResponsableAdministratif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom est requis')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le prénom est requis')]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le service est requis')]
    private ?string $service = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le poste est requis')]
    private ?string $poste = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'L\'horaire de travail est requis')]
    private ?string $horaireTravail = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Les responsabilités sont requises')]
    private ?string $responsabilites = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): static
    {
        $this->service = $service;
        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;
        return $this;
    }

    public function getHoraireTravail(): ?string
    {
        return $this->horaireTravail;
    }

    public function setHoraireTravail(string $horaireTravail): static
    {
        $this->horaireTravail = $horaireTravail;
        return $this;
    }

    public function getResponsabilites(): ?string
    {
        return $this->responsabilites;
    }

    public function setResponsabilites(string $responsabilites): static
    {
        $this->responsabilites = $responsabilites;
        return $this;
    }
} 