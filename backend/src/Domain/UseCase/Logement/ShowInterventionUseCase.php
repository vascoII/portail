<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Output\Logement\ShowInterventionOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ShowInterventionUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    \assert($inputDto instanceof ShowInterventionInputDto);
    return new ShowInterventionOutputDto($inputDto->pkLogement, $inputDto->pkIntervention);
  }
}
