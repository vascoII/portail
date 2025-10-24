<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InsertReportTokenResponse
{
    public function __construct(
        public readonly ?string $insertReportTokenResult
    ) {}
}
