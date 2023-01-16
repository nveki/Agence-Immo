<?php

namespace App\Entity;

use App\Repository\PlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlotRepository::class)]
class Plot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 6)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $plotArea = null;

    #[ORM\ManyToOne(inversedBy: 'plots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?sectors $sector = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slope = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $features = null;

    #[ORM\OneToMany(mappedBy: 'plot', targetEntity: visit::class)]
    private Collection $visits;

    #[ORM\ManyToOne(inversedBy: 'plots')]
    private ?owner $owner = null;

    #[ORM\OneToMany(mappedBy: 'plot', targetEntity: photo::class)]
    private Collection $photos;

    public function __construct()
    {
        $this->visits = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlotArea(): ?int
    {
        return $this->plotArea;
    }

    public function setPlotArea(int $plotArea): self
    {
        $this->plotArea = $plotArea;

        return $this;
    }

    public function getSector(): ?sectors
    {
        return $this->sector;
    }

    public function setSector(?sectors $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getSlope(): ?string
    {
        return $this->slope;
    }

    public function setSlope(?string $slope): self
    {
        $this->slope = $slope;

        return $this;
    }

    public function getFeatures(): ?string
    {
        return $this->features;
    }

    public function setFeatures(?string $features): self
    {
        $this->features = $features;

        return $this;
    }

    /**
     * @return Collection<int, visit>
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(visit $visit): self
    {
        if (!$this->visits->contains($visit)) {
            $this->visits->add($visit);
            $visit->setPlot($this);
        }

        return $this;
    }

    public function removeVisit(visit $visit): self
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getPlot() === $this) {
                $visit->setPlot(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?owner
    {
        return $this->owner;
    }

    public function setOwner(?owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setPlot($this);
        }

        return $this;
    }

    public function removePhoto(photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getPlot() === $this) {
                $photo->setPlot(null);
            }
        }

        return $this;
    }
}
