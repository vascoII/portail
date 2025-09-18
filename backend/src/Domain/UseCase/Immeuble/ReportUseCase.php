<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Output\Immeuble\ReportOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ReportUseCase implements UseCaseInterface
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
