<?php

declare(strict_types=1);

namespace App\Domain\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class IndexUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
