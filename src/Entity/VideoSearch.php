<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class VideoSearch{
    // this class represent the search data
    /**
     * @var string|null
    */
    private $nom;
    /**
     * @var ArrayCollection
    */
    private $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTag(): ?ArrayCollection
    {
        return $this->tag;
    }

    public function setTag(ArrayCollection $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

 
}