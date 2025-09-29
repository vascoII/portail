<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Output\Logement\ExportInterventionsOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    return $this->serviceDataProvider->exportInterventionsService($inputDto); 
  }
}
