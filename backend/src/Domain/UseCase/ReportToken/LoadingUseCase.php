<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\ReportTokenSoapInterface;

final class LoadingUseCase implements UseCaseInterface
{
  public function __construct(private readonly ReportTokenSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LoadingInputDto);
    return new LoadingOutputDto(true);
  }
}
