<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class CaseSF
{
    /**
     * @param WorkOrderSF[] $listeWorkOrderSf
     */
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $statut,
        public readonly ?string $caseNumber,
        public readonly ?string $categorie,
        public readonly ?string $sousCategorie,
        public readonly ?string $subject,
        public readonly ?string $type,
        public readonly array $listeWorkOrderSf
    ) {}
}
