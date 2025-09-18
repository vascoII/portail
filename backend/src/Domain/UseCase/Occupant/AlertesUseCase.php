<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class AlertesUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof AlertesInputDto);
    return new AlertesOutputDto([]);
  }
}
