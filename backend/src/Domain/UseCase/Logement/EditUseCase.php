<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class EditUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof EditInputDto);
    return new EditOutputDto(true);
  }
}
