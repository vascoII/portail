<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcIndicatorsOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcIndicatorsUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcIndicatorsOutputDto
  {
    return $this->serviceDataProvider->getParcIndicatorsService();
  }
}
