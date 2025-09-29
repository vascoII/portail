<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Output\Immeuble\InterventionOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class InterventionUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    return $this->serviceDataProvider->interventionService($inputDto);
  }
}
