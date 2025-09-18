<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class DeleteUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof DeleteInputDto);
    return new DeleteOutputDto(true);
  }
}
