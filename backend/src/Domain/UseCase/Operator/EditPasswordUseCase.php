<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class EditPasswordUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof EditPasswordInputDto);
    return new EditPasswordOutputDto(true);
  }
}
