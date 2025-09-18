<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ShowInterventionUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    return $this->service->showInterventionService($inputDto);
  }
}
