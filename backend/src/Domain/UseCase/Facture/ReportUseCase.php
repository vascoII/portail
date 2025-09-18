<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\FactureSoapInterface;

final class ReportUseCase implements UseCaseInterface
{
  public function __construct(private readonly FactureSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
