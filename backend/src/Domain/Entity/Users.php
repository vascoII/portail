<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Users
{
  /**
   * @param User[] $listeUsers
   */
  public function __construct(
    public readonly array $listeUsers
  ) {}
}
