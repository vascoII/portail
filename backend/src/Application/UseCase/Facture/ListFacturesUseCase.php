<?php

declare(strict_types=1);

namespace App\Application\UseCase\Facture;

use App\Application\Dto\Output\Facture\ListFacturesOutputDto;
use App\Application\Service\DataProvider\FactureDataProviderInterface;

final class ListFacturesUseCase
{
  public function __construct(
    private readonly FactureDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListFacturesOutputDto
  {
    return $this->serviceDataProvider->listFacturesService();
  }
}
