<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ExportDysfunctionsOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->exportDysfunctionsService($inputDto); 
  }
}
