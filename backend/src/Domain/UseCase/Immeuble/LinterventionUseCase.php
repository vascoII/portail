<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\LinterventionInputDto;
use App\Application\Dto\Output\Immeuble\LinterventionOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class LinterventionUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(LinterventionInputDto $inputDto): LinterventionOutputDto
  {
    return $this->service->linterventionService($inputDto);
  }
}
