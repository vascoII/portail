<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Output\Immeuble\ShowInterventionOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ShowInterventionUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    return $this->serviceDataProvider->showInterventionService($inputDto);
  }
}
