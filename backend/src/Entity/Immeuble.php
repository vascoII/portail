<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImmeubleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImmeubleRepository::class)]
//#[ApiResource]
class Immeuble
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private ?int $id = null;

  #[ORM\Column(type: 'string', length: 255)]
  private string $name;

  #[ORM\Column(type: 'string', length: 255)]
  private string $address;

  #[ORM\Column(type: 'integer')]
  private int $numApartments;

  #[ORM\OneToMany(mappedBy: 'immeuble', targetEntity: ImmeubleIndicator::class, cascade: ['persist', 'remove'])]
  private Collection $indicators;

  public function __construct()
  {
    $this->indicators = new ArrayCollection();
  }

  // --- Getters / Setters ---
  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }

  public function getAddress(): string
  {
    return $this->address;
  }

  public function setAddress(string $address): self
  {
    $this->address = $address;
    return $this;
  }

  public function getNumApartments(): int
  {
    return $this->numApartments;
  }

  public function setNumApartments(int $numApartments): self
  {
    $this->numApartments = $numApartments;
    return $this;
  }

  /**
   * @return Collection<int, ImmeubleIndicator>
   */
  public function getIndicators(): Collection
  {
    return $this->indicators;
  }

  public function addIndicator(ImmeubleIndicator $indicator): self
  {
    if (!$this->indicators->contains($indicator)) {
      $this->indicators[] = $indicator;
      $indicator->setImmeuble($this);
    }

    return $this;
  }

  public function removeIndicator(ImmeubleIndicator $indicator): self
  {
    if ($this->indicators->removeElement($indicator)) {
      if ($indicator->getImmeuble() === $this) {
        $indicator->setImmeuble(null);
      }
    }

    return $this;
  }
}
