<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ExportAnomaliesOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportAnomaliesUseCase implements UseCaseInterface
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportAnomaliesInputDto);
    return new ExportAnomaliesOutputDto(true);
  }
}
