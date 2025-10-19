<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcSerieConsosEAUOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcSerieConsosEAUUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcSerieConsosEAUOutputDto
  {
    return $this->serviceDataProvider->getParcSerieConsosEAUService();
  }
}
