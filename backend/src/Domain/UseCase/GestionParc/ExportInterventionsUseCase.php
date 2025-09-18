<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportInterventionsOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    \assert($inputDto instanceof ExportInterventionsInputDto);
    return new ExportInterventionsOutputDto(true);
  }
}
