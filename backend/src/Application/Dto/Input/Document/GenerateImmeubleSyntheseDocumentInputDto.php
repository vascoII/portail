<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateImmeubleSyntheseDocumentInputDto
{
  public function __construct(
    public readonly ?string $pkImmeuble,
    public readonly ?string $pkUser,
    public readonly string $date1,
    public readonly string $date2
  ) {}
}
