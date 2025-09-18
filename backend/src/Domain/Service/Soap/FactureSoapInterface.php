<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Facture\ReportInputDto;

interface FactureSoapInterface
{
  public function indexService(): array;
  public function reportService(ReportInputDto $inputDto): array;
}
