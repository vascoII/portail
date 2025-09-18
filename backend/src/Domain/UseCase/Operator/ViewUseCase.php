<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ViewUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ViewInputDto);
    return new ViewOutputDto(['id' => $inputDto->operatorId]);
  }
}
