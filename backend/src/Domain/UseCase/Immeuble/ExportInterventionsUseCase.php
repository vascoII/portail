<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportInterventionsOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    return $this->serviceDataProvider->exportInterventionsService($inputDto);
  }
}
