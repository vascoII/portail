<?php

declare(strict_types=1);

namespace App\Application\UseCase\External;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto ;
use App\Application\Dto\Output\External\GetReportByTokenOutputDto;
use App\Application\Service\DataProvider\ExternalDataProviderInterface;
use App\Application\Service\Builder\PdfReportBuilderInterface;

final class GetReportByTokenUseCase
{
  public function __construct(
    private readonly ExternalDataProviderInterface $serviceDataProvider,
    private readonly PdfReportBuilderInterface $reportBuilderInterface
  ) {}

  public function execute(GetByIdStringInputDto  $inputDto): GetReportByTokenOutputDto
  {
    $reportByTokenDataSourceOutputDto = $this->serviceDataProvider->getReportByTokenService($inputDto); 
    return $this->reportBuilderInterface->generateDocumentReportByTokenService($reportByTokenDataSourceOutputDto);
  }
}
