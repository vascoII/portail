<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Output\Facture\GetFacturesOutputDto;
use App\Application\Service\DataProvider\FactureDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly FactureDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetFacturesOutputDto
  {
    return $this->serviceDataProvider->indexService();
  }
}
