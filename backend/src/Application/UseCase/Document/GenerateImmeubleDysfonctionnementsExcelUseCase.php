<?php

declare(strict_types=1);

namespace App\Application\UseCase\Document;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;

final class GenerateImmeubleDysfonctionnementsExcelUseCase
{
  public function __construct(
    private readonly DocumentDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    return $this->serviceDataProvider->generateImmeubleDysfonctionnementsExcelService($inputDto);
  }
}
