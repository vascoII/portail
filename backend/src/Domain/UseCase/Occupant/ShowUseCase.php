<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowUseInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ShowUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowUseInputDto);
    return new ShowOutputDto([]);
  }
}
