<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Output\Logement\ExportOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ExportInputDto $inputDto): ExportOutputDto
  {
    \assert($inputDto instanceof ExportInputDto);
    return new ExportOutputDto(true);
  }
}
