<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class WorkOrderLineItemSF
{
    public function __construct(
        public readonly string $assetSerialNumber,
        public readonly string $workType,
        public readonly ?string $motifExecution,
        public readonly ?string $motifNonExecution,
        public readonly string $statut
    ) {}
}
