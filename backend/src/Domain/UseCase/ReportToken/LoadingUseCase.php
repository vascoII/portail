<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Output\ReportToken\LoadingOutputDto;

use App\Domain\Service\Soap\ReportTokenSoapInterface;

final class LoadingUseCase
{
  public function __construct(private readonly ReportTokenSoapInterface $service) {}

  public function execute(LoadingInputDto $inputDto): LoadingOutputDto
  {
    \assert($inputDto instanceof LoadingInputDto);
    return new LoadingOutputDto(true);
  }
}
