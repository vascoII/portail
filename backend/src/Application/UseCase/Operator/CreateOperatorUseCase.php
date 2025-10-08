<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class CreateOperatorUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CreateOperatorInputDto $inputDto): SuccessOutputDto
  {
    return $this->serviceDataProvider->createOperatorService($inputDto);
  }
}
