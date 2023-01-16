<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
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
    private ?string $address = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $homeArea = null;

    #[ORM\Column]
    private ?int $plotArea = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $roomNumber = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bathroomNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $exposure = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bedroomNumber = null;

    #[ORM\Column]
    private ?bool $garage = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $parking = null;

    #[ORM\Column]
    private ?bool $separatedWc = null;

    #[ORM\Column]
    private ?int $linvingArea = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?propertyType $propertyType = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    private ?Owner $owner = null;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: Visit::class)]
    private Collection $visits;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: Photo::class)]
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHomeArea(): ?int
    {
        return $this->homeArea;
    }

    public function setHomeArea(int $homeArea): self
    {
        $this->homeArea = $homeArea;

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

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(?int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getBathroomNumber(): ?int
    {
        return $this->bathroomNumber;
    }

    public function setBathroomNumber(?int $bathroomNumber): self
    {
        $this->bathroomNumber = $bathroomNumber;

        return $this;
    }


    public function getExposure(): ?string
    {
        return $this->exposure;
    }

    public function setExposure(string $exposure): self
    {
        $this->exposure = $exposure;

        return $this;
    }

    public function getBedroomNumber(): ?int
    {
        return $this->bedroomNumber;
    }

    public function setBedroomNumber(?int $bedroomNumber): self
    {
        $this->bedroomNumber = $bedroomNumber;

        return $this;
    }

    public function isGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(bool $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getParking(): ?int
    {
        return $this->parking;
    }

    public function setParking(?int $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function isSeparatedWc(): ?bool
    {
        return $this->separatedWc;
    }

    public function setSeparatedWc(bool $separatedWc): self
    {
        $this->separatedWc = $separatedWc;

        return $this;
    }

    public function getLinvingArea(): ?int
    {
        return $this->linvingArea;
    }

    public function setLinvingArea(int $linvingArea): self
    {
        $this->linvingArea = $linvingArea;

        return $this;
    }

    public function getPropertyType(): ?propertyType
    {
        return $this->propertyType;
    }

    public function setPropertyType(?propertyType $propertyType): self
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Visit>
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visit $visit): self
    {
        if (!$this->visits->contains($visit)) {
            $this->visits->add($visit);
            $visit->setProperty($this);
        }

        return $this;
    }

    public function removeVisit(Visit $visit): self
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getProperty() === $this) {
                $visit->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setProperty($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProperty() === $this) {
                $photo->setProperty(null);
            }
        }

        return $this;
    }
}
