<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticket;

final class GetAttachmentInputDto 
{
    public function __construct(
        public readonly int $pkTicketInter
    ) {}
}
