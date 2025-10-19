<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcSerieConsosCompteurGeneralOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcSerieConsosCompteurGeneralUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcSerieConsosCompteurGeneralOutputDto
  {
    return $this->serviceDataProvider->getParcSerieConsosCompteurGeneralService();
  }
}
