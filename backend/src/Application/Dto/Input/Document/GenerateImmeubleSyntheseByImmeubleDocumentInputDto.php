<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateImmeubleSyntheseByImmeubleDocumentInputDto
{
  public function __construct(
    public readonly ?int $pkImmeuble,
    public readonly string $date1,
    public readonly string $date2
  ) {}
}
