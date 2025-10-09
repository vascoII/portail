<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class PatchOperatorUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(PatchOperatorInputDto $inputDto): SuccessOutputDto
  {
    return $this->serviceDataProvider->patchOperatorService($inputDto);
  }
}
