<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticketing;

final class GetAttachmentInputDto 
{
    public function __construct(
        public readonly int $pkTicketInter
    ) {}
}
