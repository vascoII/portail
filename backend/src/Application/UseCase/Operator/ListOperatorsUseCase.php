<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class ListOperatorsUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListOperatorsInputDto $inputDto): ListOperatorsOutputDto
  {
    return $this->serviceDataProvider->listOperatorsService($inputDto);
  }
}
