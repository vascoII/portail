<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Output\GestionParc\ReportOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ReportUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
