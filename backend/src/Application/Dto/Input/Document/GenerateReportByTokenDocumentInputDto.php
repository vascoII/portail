<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateReportByTokenDocumentInputDto
{
  public function __construct(
    public readonly string $tokenId
  ) {}
}

