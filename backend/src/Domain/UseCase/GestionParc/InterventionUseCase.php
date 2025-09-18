<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class InterventionUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    return $this->service->interventionService($inputDto);
  }
}
