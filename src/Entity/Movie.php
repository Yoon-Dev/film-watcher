<?php

namespace App\Entity;

use App\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 * @Vich\Uploadable
 */
class Movie
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $acteurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realisateur;

        /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="movie_image", fileNameProperty="image_name")
     * @Assert\Image
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $image_name;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTimeInterface|null
     */
    private $image_updated_at;
// ++++++++++++++++++++++++++++++++++++++++++++++
// MOVIE
// ++++++++++++++++++++++++++++++++++++++++++++++
        /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="movie_video", fileNameProperty="video_name")
     * @var File|null
     */
    private $videoFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $video_name;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTimeInterface|null
     */
    private $video_updated_at;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="movies")
     * @ORM\JoinTable(name="movie_tag",
     *     joinColumns={@ORM\JoinColumn(name="movie_id", referencedColumnName="id")}
     *     )
     */
    private $tags;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        // get all the tag
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getActeurs(): ?string
    {
        return $this->acteurs;
    }

    public function setActeurs(string $acteurs): self
    {
        $this->acteurs = $acteurs;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->image_updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(?string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function getImageUpdatedAt(): ?\DateTimeInterface
    {
        return $this->image_updated_at;
    }

    public function setImageUpdatedAt(\DateTimeInterface $image_updated_at): self
    {
        $this->image_updated_at = $image_updated_at;

        return $this;
    }
// ++++++++++++++++++++++++++++++++++++++++++++++
// VIDEO
// ++++++++++++++++++++++++++++++++++++++++++++++
    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }

    public function setVideoFile(File $videoFile): self
    {
        $this->videoFile = $videoFile;
        if ($this->videoFile instanceof UploadedFile) {
            $this->video_updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getVideoName(): ?string
    {
        return $this->video_name;
    }

    public function setVideoName(?string $video_name): self
    {
        $this->video_name = $video_name;

        return $this;
    }

    public function getVideoUpdatedAt(): ?\DateTimeInterface
    {
        return $this->video_updated_at;
    }

    public function setVideoUpdatedAt(\DateTimeInterface $video_updated_at): self
    {
        $this->video_updated_at = $video_updated_at;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addMovie($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeMovie($this);
        }

        return $this;
    }

}
