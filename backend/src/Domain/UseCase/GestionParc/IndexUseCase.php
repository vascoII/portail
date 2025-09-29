<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService($inputDto);
  }
}
