<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $saison;

    /**
     * @ORM\Column(type="integer")
     */
    private $episode;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, options={"default" : "non"})
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaison(): ?int
    {
        return $this->saison;
    }

    public function setSaison(int $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function getEpisode(): ?int
    {
        return $this->episode;
    }

    public function setEpisode(int $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
