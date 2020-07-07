<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 */
class Activite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateActivite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $noteActivite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Departement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateActivite(): ?\DateTimeInterface
    {
        return $this->dateActivite;
    }

    public function setDateActivite(?\DateTimeInterface $dateActivite): self
    {
        $this->dateActivite = $dateActivite;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getNoteActivite(): ?int
    {
        return $this->noteActivite;
    }

    public function setNoteActivite(?int $noteActivite): self
    {
        $this->noteActivite = $noteActivite;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->Departement;
    }

    public function setDepartement(?string $Departement): self
    {
        $this->Departement = $Departement;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
