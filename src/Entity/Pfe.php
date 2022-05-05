<?php

namespace App\Entity;

use App\Repository\PfeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PfeRepository::class)]
class Pfe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titre;

    #[ORM\Column(type: 'string', length: 50)]
    private $nometudiant;

    #[ORM\ManyToOne(targetEntity: Entreprise::class, inversedBy: 'pves')]
    #[ORM\JoinColumn(nullable: false)]
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNometudiant(): ?string
    {
        return $this->nometudiant;
    }

    public function setNometudiant(string $nometudiant): self
    {
        $this->nometudiant = $nometudiant;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNometudiant().' '.$this->getTitre().' '.$this->getEntreprise() ;
        // TODO: Implement __toString() method.
    }
}
