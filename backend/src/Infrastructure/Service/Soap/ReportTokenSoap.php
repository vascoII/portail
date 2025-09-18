<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;
use App\Domain\Service\Soap\ReportTokenSoapInterface;

final class ReportTokenSoap implements ReportTokenSoapInterface
{
  public function loadingService(LoadingInputDto $inputDto): LoadingOutputDto
  {
    // TODO: Implement loadingService logic
    return new LoadingOutputDto(true);
  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
    // TODO: Implement reportService logic
    return new ReportOutputDto(true);
  }
}
