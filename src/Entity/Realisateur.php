<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RealisateurRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=RealisateurRepository::class)
 * @Vich\Uploadable
 */
class Realisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $portrait;
    /**
     * @Vich\UploadableField(mapping="portrait_config", fileNameProperty="portrait")
     */
    private $portraitFile;


    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="realisateur")
     */
    private $films;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $maj;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function __toString(){

        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPortrait(): ?string
    {
        return $this->portrait;
    }

    public function setPortrait(?string $portrait): self
    {
        $this->portrait = $portrait;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->setRealisateur($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getRealisateur() === $this) {
                $film->setRealisateur(null);
            }
        }

        return $this;
    }

    public function getMaj(): ?\DateTimeInterface
    {
        return $this->maj;
    }

    public function setMaj(?\DateTimeInterface $maj): self
    {
        $this->maj = $maj;

        return $this;
    }

    public function getPortraitFile(){
        return $this->portraitFile;
    }
    public function setPortraitFile(File $file){
        $this->portraitFile=$file;

        if( $file !==null ){
            $this->maj = new \DateTime();
        }
        return $this;
    }
}
