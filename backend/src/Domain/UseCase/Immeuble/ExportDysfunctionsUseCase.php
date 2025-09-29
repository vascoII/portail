<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportDysfunctionsOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->exportDysfunctionsService($inputDto);
  }
}
