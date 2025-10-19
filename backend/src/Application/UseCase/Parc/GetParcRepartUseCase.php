<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcRepartOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcRepartUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcRepartOutputDto
  {
    return $this->serviceDataProvider->getParcRepartService();
  }
}
