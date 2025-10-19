<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcElectOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcElectUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcElectOutputDto
  {
    return $this->serviceDataProvider->getParcElectService();
  }
}
