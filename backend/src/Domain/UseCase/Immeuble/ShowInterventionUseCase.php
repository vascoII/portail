<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Output\Immeuble\ShowInterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ShowInterventionUseCase implements UseCaseInterface
{
  public function __construct(private readonly ImmeubleSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowInterventionInputDto);
    return new ShowInterventionOutputDto($inputDto->pkImmeuble, $inputDto->pkIntervention);
  }
}
