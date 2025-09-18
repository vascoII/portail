<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\LinterventionInputDto;
use App\Application\Dto\Output\Immeuble\LinterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class LinterventionUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LinterventionInputDto);
    return new LinterventionOutputDto([]);
  }
}
