<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ExportLeaksOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    return $this->serviceDataProvider->exportLeaksService($inputDto);
  }
}
