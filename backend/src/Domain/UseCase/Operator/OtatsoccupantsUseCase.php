<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class OtatsoccupantsUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof OtatsoccupantsInputDto);
    return new OtatsoccupantsOutputDto([]);
  }
}
