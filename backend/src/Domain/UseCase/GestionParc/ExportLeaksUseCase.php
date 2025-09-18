<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ExportLeaksOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportLeaksUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    \assert($inputDto instanceof ExportLeaksInputDto);
    return new ExportLeaksOutputDto(true);
  }
}
