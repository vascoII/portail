<?php

declare(strict_types=1);

namespace App\Application\UseCase;

interface UseCaseInterface
{
  public function execute(object $inputDto): object;
}
