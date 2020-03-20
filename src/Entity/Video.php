<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=2048)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $serie_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $soustitre_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tag;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $directeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $producteur;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $acteurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function slug(): ?string
    {
        return (new Slugify())->slugify($this->nom);
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSerieId(): ?int
    {
        return $this->serie_id;
    }

    public function setSerieId(?int $serie_id): self
    {
        $this->serie_id = $serie_id;

        return $this;
    }

    public function getSoustitreId(): ?int
    {
        return $this->soustitre_id;
    }

    public function setSoustitreId(?int $soustitre_id): self
    {
        $this->soustitre_id = $soustitre_id;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDirecteur(): ?string
    {
        return $this->directeur;
    }

    public function setDirecteur(?string $directeur): self
    {
        $this->directeur = $directeur;

        return $this;
    }

    public function getProducteur(): ?string
    {
        return $this->producteur;
    }

    public function setProducteur(?string $producteur): self
    {
        $this->producteur = $producteur;

        return $this;
    }

    public function getActeurs(): ?string
    {
        return $this->acteurs;
    }

    public function setActeurs(?string $acteurs): self
    {
        $this->acteurs = $acteurs;

        return $this;
    }
}
