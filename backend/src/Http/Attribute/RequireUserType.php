<?php

declare(strict_types=1);

namespace App\Http\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
final class RequireUserType
{
  public function __construct(
    public readonly array $allowedTypes
  ) {
    // Valider que seuls C, G, O sont utilisés
    $validTypes = ['C', 'G', 'O'];
    foreach ($allowedTypes as $type) {
      if (!in_array($type, $validTypes, true)) {
        throw new \InvalidArgumentException("Invalid user type: {$type}. Must be one of: " . implode(', ', $validTypes));
      }
    }
  }
}
