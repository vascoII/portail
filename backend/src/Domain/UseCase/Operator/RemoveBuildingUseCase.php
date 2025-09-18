<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class RemoveBuildingUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof RemoveBuildingInputDto);
    return new RemoveBuildingOutputDto(true);
  }
}
