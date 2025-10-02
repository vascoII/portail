<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService($inputDto);
  }
}
