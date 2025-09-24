<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Infrastructure\Transformer\ReportTokenTransformer;
use App\Domain\Service\Soap\ReportTokenSoapInterface;

final class LoadingUseCase
{
  public function __construct(
    private readonly ReportTokenSoapInterface $service,
    private readonly ReportTokenTransformer $transformer
  ) {}

  public function execute(LoadingInputDto $inputDto): LoadingOutputDto
  {
    $serviceResponse = $this->service->loadingService($inputDto);
    return $this->transformer->transformLoadingResponse($serviceResponse);
  }
}
