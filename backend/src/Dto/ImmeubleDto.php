<?php

namespace App\Dto;

class ImmeubleDto
{
  public int $id;
  public string $name;
  public string $address;
  public int $numApartments;

  /** @var IndicatorDto[] */
  public array $indicators = [];

  public function __construct(
    int $id,
    string $name,
    string $address,
    int $numApartments,
    array $indicators = []
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->address = $address;
    $this->numApartments = $numApartments;
    $this->indicators = $indicators;
  }
}
