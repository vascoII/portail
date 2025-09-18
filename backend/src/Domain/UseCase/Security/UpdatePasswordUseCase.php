<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class UpdatePasswordUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof UpdatePasswordInputDto);
    return new UpdatePasswordOutputDto(true);
  }
}
