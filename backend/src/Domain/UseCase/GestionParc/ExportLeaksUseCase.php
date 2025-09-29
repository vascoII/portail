<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ExportLeaksOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    return $this->serviceDataProvider->exportLeaksService($inputDto);
  }
}
