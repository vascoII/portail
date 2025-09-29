<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ShowInterventionUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    return $this->serviceDataProvider->showInterventionService($inputDto);
  }
}
