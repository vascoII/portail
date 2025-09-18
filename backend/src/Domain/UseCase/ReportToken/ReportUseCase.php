<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\ReportTokenSoapInterface;

final class ReportUseCase implements UseCaseInterface
{
  public function __construct(private readonly ReportTokenSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ReportInputDto);
    return new ReportOutputDto(true);
  }
}
