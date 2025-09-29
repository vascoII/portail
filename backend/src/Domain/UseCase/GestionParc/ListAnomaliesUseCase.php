<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    return $this->serviceDataProvider->listAnomaliesService($inputDto);
  }
}
