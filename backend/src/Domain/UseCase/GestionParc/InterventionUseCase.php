<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class InterventionUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    return $this->serviceDataProvider->interventionService($inputDto);
  }
}
