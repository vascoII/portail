<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticket;

final class GetTicketsIntersUserInputDto 
{
    public function __construct(
        public readonly string $paramsFiltres
    ) {}
}
