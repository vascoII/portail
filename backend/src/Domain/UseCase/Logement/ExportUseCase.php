<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Output\Logement\ExportOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ExportUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ExportInputDto $inputDto): ExportOutputDto
  {
    return $this->serviceDataProvider->exportService($inputDto); 
  }
}
