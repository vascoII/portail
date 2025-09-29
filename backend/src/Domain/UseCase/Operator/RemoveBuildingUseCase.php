<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class RemoveBuildingUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(RemoveBuildingInputDto $inputDto): RemoveBuildingOutputDto
  {
    return $this->serviceDataProvider->removeBuildingService($inputDto);
  }
}
