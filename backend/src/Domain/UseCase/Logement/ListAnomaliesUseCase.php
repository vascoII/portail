<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    return $this->serviceDataProvider->listAnomaliesService($inputDto);
  }
}
