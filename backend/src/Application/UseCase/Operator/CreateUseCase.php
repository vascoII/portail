<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Output\Operator\CreateOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class CreateUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CreateInputDto $inputDto): CreateOutputDto
  {
    return $this->serviceDataProvider->createService($inputDto);
  }
}
