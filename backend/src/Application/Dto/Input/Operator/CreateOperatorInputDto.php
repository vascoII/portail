<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class CreateOperatorInputDto
{
  public function __construct(
    public readonly string $email,
    public readonly string $lastname,
    public readonly string $firstname,
    public readonly string $phone,
    public readonly string $job
  ) {}
}
