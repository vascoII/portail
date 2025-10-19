<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcOutputDto
  {
    return $this->serviceDataProvider->getParcService();
  }
}
