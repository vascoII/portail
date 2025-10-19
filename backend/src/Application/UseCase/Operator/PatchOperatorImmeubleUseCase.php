<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class PatchOperatorImmeubleUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(PatchOperatorImmeubleInputDto $inputDto): SuccessOutputDto
  {
    return $this->serviceDataProvider->patchOperatorImmeubleService($inputDto);
  }
}
