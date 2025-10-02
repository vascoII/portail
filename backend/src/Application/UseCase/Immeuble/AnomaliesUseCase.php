<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\AnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class AnomaliesUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(AnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    return $this->serviceDataProvider->listAnomaliesService($inputDto);
  }
}
