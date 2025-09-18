<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportDysfunctionsOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    \assert($inputDto instanceof ExportDysfunctionsInputDto);
    return new ExportDysfunctionsOutputDto(true);
  }
}
