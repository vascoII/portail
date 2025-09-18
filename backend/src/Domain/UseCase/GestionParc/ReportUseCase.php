<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Output\GestionParc\ReportOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ReportUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
