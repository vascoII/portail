<?php

declare(strict_types=1);

namespace App\Application\UseCase\GestionParc;

use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService();
  }
}
