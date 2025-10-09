<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class GetOperatorUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdIntInputDto $inputDto): GetOperatorOutputDto
  {
    return $this->serviceDataProvider->getOperatorService($inputDto);
  }
}
