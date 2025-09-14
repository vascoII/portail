<?php

namespace App\Service;

use App\Dto\ImmeubleDto;
use App\Dto\IndicatorDto;
use App\Entity\Immeuble;
use App\Entity\ImmeubleIndicator;

class EntityToDtoTransformer
{
  /**
   * Transforme une entity Immeuble en ImmeubleDto
   */
  public function transformImmeuble(Immeuble $immeuble, bool $withIndicators = true): ImmeubleDto
  {
    $indicators = [];

    if ($withIndicators) {
      foreach ($immeuble->getIndicators() as $indicator) {
        $indicators[] = $this->transformIndicator($indicator);
      }
    }

    return new ImmeubleDto(
      $immeuble->getId(),
      $immeuble->getName(),
      $immeuble->getAddress(),
      $immeuble->getNumApartments(),
      $indicators
    );
  }

  /**
   * Transforme une entity ImmeubleIndicator en IndicatorDto
   */
  public function transformIndicator(ImmeubleIndicator $indicator): IndicatorDto
  {
    return new IndicatorDto(
      $indicator->getId(),
      $indicator->getKpiName(),
      $indicator->getKpiValue(),
      $indicator->getUpdatedAt()
    );
  }
}
