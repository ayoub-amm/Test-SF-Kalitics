<?php

namespace App\Entity;

use App\Repository\PointagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator as PointageAssert;


/**
 * @ORM\Entity(repositoryClass=PointagesRepository::class)
 *  * @UniqueEntity(
 *     fields={"utilisateur", "chantier","date"},
 *     message="ne peut pas être pointé deux fois dans le même jour sur le même chantier."
 * )
 * @PointageAssert\DureeByuserInWeek;
 */
class Pointages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Chantiers::class, inversedBy="pointages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chantier;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $duree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateurs
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateurs $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getChantier(): ?Chantiers
    {
        return $this->chantier;
    }

    public function setChantier(?Chantiers $chantier): self
    {
        $this->chantier = $chantier;

        return $this;
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

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(float $duree): self
    {
        $this->duree = $duree;

        return $this;
    }
}
