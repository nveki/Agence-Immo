<?php

namespace App\Entity;

use App\Repository\SectorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectorsRepository::class)]
class Sectors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'researchSectors')]
    private Collection $clients;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: Plot::class)]
    private Collection $plots;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->plots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->addResearchSector($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            $client->removeResearchSector($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Plot>
     */
    public function getPlots(): Collection
    {
        return $this->plots;
    }

    public function addPlot(Plot $plot): self
    {
        if (!$this->plots->contains($plot)) {
            $this->plots->add($plot);
            $plot->setSector($this);
        }

        return $this;
    }

    public function removePlot(Plot $plot): self
    {
        if ($this->plots->removeElement($plot)) {
            // set the owning side to null (unless already changed)
            if ($plot->getSector() === $this) {
                $plot->setSector(null);
            }
        }

        return $this;
    }
}
