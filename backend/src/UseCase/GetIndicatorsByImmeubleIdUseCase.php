<?php

namespace App\UseCase;

use App\Dto\IndicatorDto;
use App\Service\ImmeubleSoapProviderInterface;

class GetIndicatorsByImmeubleIdUseCase
{
  public function __construct(private ImmeubleSoapProviderInterface $provider) {}

  /**
   * Retourne un tableau de IndicatorDto
   * @return IndicatorDto[]
   */
  public function execute(int $immeubleId): array
  {
    return $this->provider->getIndicatorsByImmeubleId($immeubleId);
  }
}
