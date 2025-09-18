<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class AddBuildingInputDto
{
  public function __construct(public readonly string $operatorId) {}
}
