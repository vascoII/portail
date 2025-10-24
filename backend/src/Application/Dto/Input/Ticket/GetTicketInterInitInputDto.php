<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticket;

final class GetTicketInterInitInputDto 
{
    public function __construct(
        public readonly int $pkLogement
    ) {}
}
