<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class CreateGestionnaireInputDto
{
  public function __construct(
    public readonly int $pkUser,
    public readonly string $email,
    public readonly string $lastname,
    public readonly string $firstname,
    public readonly string $phone,
    public readonly string $job
  ) {}
}
