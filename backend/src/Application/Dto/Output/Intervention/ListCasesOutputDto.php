<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Intervention;

use App\Domain\Entity\Immeuble;

final class ListCasesOutputDto
{
 
  public function __construct(
    public readonly bool $success
  ) {}
}