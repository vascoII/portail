<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Application\Service\DataProvider\ReportTokenDataProviderInterface;

final class LoadingUseCase
{
  public function __construct(
    private readonly ReportTokenDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(LoadingInputDto $inputDto): LoadingOutputDto
  {
    return $this->serviceDataProvider->loadingService($inputDto);
  }
}
