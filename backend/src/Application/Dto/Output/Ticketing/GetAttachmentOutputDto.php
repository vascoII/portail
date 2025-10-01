<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class GetAttachmentOutputDto
{
  public function __construct(
    public readonly string $fileContent
  ) {}
}
