<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

use App\Application\Dto\Output\Shared\SuccessOutputDto;

final class CreateOutputDto extends SuccessOutputDto
{
  public function __construct(bool $success)
  {
    parent::__construct($success);
  }
}
