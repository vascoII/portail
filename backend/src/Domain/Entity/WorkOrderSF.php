<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class WorkOrderSF
{
    /**
     * @param WorkOrderLineItemSF[] $listeWorkOrderLineItemSF
     */
    public function __construct(
        public readonly string $workOrderNumber,
        public readonly string $statut,
        public readonly \DateTimeImmutable $schedStartTime,
        public readonly string $techArrivalStartTime,
        public readonly string $techArrivalEndTime,
        public readonly string $idImm,
        public readonly string $codeGestioImm,
        public readonly ?Logement $logement,
        public readonly ?Occupant $occupant,
        public readonly array $listeWorkOrderLineItemSF
    ) {}
}
