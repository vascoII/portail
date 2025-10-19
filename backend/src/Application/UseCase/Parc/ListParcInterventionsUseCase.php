<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\ListParcInterventionsOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class ListParcInterventionsUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListParcInterventionsOutputDto
  {
    return $this->serviceDataProvider->listParcInterventionsService();
  }
}
