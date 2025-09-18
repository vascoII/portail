<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Intervention;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;

use App\Domain\Service\Soap\InterventionSoapInterface;

final class ReportUseCase
{
  public function __construct(private readonly InterventionSoapInterface $service) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
