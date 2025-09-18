<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;

use App\Domain\Service\Soap\FactureSoapInterface;

final class ReportUseCase
{
  public function __construct(private readonly FactureSoapInterface $service) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
