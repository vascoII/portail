<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class AddBuildingOutputDto
{
  public function __construct(public readonly bool $added) {}
}
