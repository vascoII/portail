<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Output\Logement\ExportLeaksOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    return $this->serviceDataProvider->exportLeaksService($inputDto); 
  }
}
