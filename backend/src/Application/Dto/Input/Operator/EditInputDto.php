<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class EditInputDto
{
  public function __construct(
    public readonly string $pkUserChild,
    public readonly string $loginId,
    public readonly string $userName,
    public readonly string $firstName,
    public readonly string $phoneNumber,
    public readonly string $email,
    public readonly string $userRole  
  ) {}
}
