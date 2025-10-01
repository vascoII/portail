<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticketing;

final class SetTicketStatusInputDto 
{
    public function __construct(
        public readonly int $pkTicket,
        public readonly string $statut
    ) {}
}
