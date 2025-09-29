<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    return $this->serviceDataProvider->listAnomaliesService($inputDto);
  }
}
