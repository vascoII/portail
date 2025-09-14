<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImmeubleIndicatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImmeubleIndicatorRepository::class)]
#[ApiResource]
class ImmeubleIndicator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Immeuble::class, inversedBy: 'indicators')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Immeuble $immeuble = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $kpiName;

    #[ORM\Column(type: 'float')]
    private float $kpiValue;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    // --- Getters / Setters ---
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmeuble(): ?Immeuble
    {
        return $this->immeuble;
    }

    public function setImmeuble(?Immeuble $immeuble): self
    {
        $this->immeuble = $immeuble;
        return $this;
    }

    public function getKpiName(): string
    {
        return $this->kpiName;
    }

    public function setKpiName(string $kpiName): self
    {
        $this->kpiName = $kpiName;
        return $this;
    }

    public function getKpiValue(): float
    {
        return $this->kpiValue;
    }

    public function setKpiValue(float $kpiValue): self
    {
        $this->kpiValue = $kpiValue;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
