<?php

namespace App\Dto;

class IndicatorDto
{
  public int $id;
  public string $kpiName;
  public float $kpiValue;
  public \DateTimeInterface $updatedAt;

  public function __construct(
    int $id,
    string $kpiName,
    float $kpiValue,
    \DateTimeInterface $updatedAt
  ) {
    $this->id = $id;
    $this->kpiName = $kpiName;
    $this->kpiValue = $kpiValue;
    $this->updatedAt = $updatedAt;
  }
}
