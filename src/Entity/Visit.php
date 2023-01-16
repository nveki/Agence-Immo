<?php

namespace App\Entity;

use App\Repository\VisitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitRepository::class)]
class Visit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $appointementTime = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $report = null;

    #[ORM\ManyToOne(inversedBy: 'visits')]
    private ?client $client = null;

    #[ORM\ManyToOne(inversedBy: 'visits')]
    private ?property $property = null;

    #[ORM\ManyToOne(inversedBy: 'visits')]
    private ?Plot $plot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppointementTime(): ?\DateTimeImmutable
    {
        return $this->appointementTime;
    }

    public function setAppointementTime(\DateTimeImmutable $appointementTime): self
    {
        $this->appointementTime = $appointementTime;

        return $this;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(string $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getProperty(): ?property
    {
        return $this->property;
    }

    public function setProperty(?property $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getPlot(): ?Plot
    {
        return $this->plot;
    }

    public function setPlot(?Plot $plot): self
    {
        $this->plot = $plot;

        return $this;
    }
}
