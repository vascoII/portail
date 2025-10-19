<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcEFOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcEFUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcEFOutputDto
  {
    return $this->serviceDataProvider->getParcEFService();
  }
}
