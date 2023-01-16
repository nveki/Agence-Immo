<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column]
    private ?int $budgetMin = null;

    #[ORM\Column]
    private ?int $budgetMax = null;

    #[ORM\Column]
    private ?int $homeArea = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $bedroomNumber = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $bathroomNumber = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $roomNumber = null;

    #[ORM\Column]
    private ?int $plotAreaMin = null;

    #[ORM\Column]
    private ?int $plotAreaMax = null;

    #[ORM\ManyToMany(targetEntity: sectors::class, inversedBy: 'clients')]
    private Collection $researchSectors;

    #[ORM\ManyToMany(targetEntity: propertyType::class, inversedBy: 'clients')]
    private Collection $researchTypes;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Visit::class)]
    private Collection $visits;

    public function __construct()
    {
        $this->researchSectors = new ArrayCollection();
        $this->researchTypes = new ArrayCollection();
        $this->visits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getBudgetMin(): ?int
    {
        return $this->budgetMin;
    }

    public function setBudgetMin(int $budgetMin): self
    {
        $this->budgetMin = $budgetMin;

        return $this;
    }

    public function getBudgetMax(): ?int
    {
        return $this->budgetMax;
    }

    public function setBudgetMax(int $budgetMax): self
    {
        $this->budgetMax = $budgetMax;

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

    public function getBedroomNumber(): ?int
    {
        return $this->bedroomNumber;
    }

    public function setBedroomNumber(int $bedroomNumber): self
    {
        $this->bedroomNumber = $bedroomNumber;

        return $this;
    }

    public function getBathroomNumber(): ?int
    {
        return $this->bathroomNumber;
    }

    public function setBathroomNumber(int $bathroomNumber): self
    {
        $this->bathroomNumber = $bathroomNumber;

        return $this;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getPlotAreaMin(): ?int
    {
        return $this->plotAreaMin;
    }

    public function setPlotAreaMin(int $plotAreaMin): self
    {
        $this->plotAreaMin = $plotAreaMin;

        return $this;
    }

    public function getPlotAreaMax(): ?int
    {
        return $this->plotAreaMax;
    }

    public function setPlotAreaMax(int $plotAreaMax): self
    {
        $this->plotAreaMax = $plotAreaMax;

        return $this;
    }


    /**
     * @return Collection<int, sectors>
     */
    public function getResearchSectors(): Collection
    {
        return $this->researchSectors;
    }

    public function addResearchSector(sectors $researchSector): self
    {
        if (!$this->researchSectors->contains($researchSector)) {
            $this->researchSectors->add($researchSector);
        }

        return $this;
    }

    public function removeResearchSector(sectors $researchSector): self
    {
        $this->researchSectors->removeElement($researchSector);

        return $this;
    }

    /**
     * @return Collection<int, propertyType>
     */
    public function getResearchTypes(): Collection
    {
        return $this->researchTypes;
    }

    public function addResearchType(propertyType $researchType): self
    {
        if (!$this->researchTypes->contains($researchType)) {
            $this->researchTypes->add($researchType);
        }

        return $this;
    }

    public function removeResearchType(propertyType $researchType): self
    {
        $this->researchTypes->removeElement($researchType);

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
            $visit->setClient($this);
        }

        return $this;
    }

    public function removeVisit(Visit $visit): self
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getClient() === $this) {
                $visit->setClient(null);
            }
        }

        return $this;
    }
}
