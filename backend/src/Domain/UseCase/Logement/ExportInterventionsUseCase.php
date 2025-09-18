<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Output\Logement\ExportInterventionsOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    \assert($inputDto instanceof ExportInterventionsInputDto);
    return new ExportInterventionsOutputDto(true);
  }
}
