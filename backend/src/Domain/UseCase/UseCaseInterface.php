<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

interface UseCaseInterface
{
  public function execute(object $inputDto): object;
}
