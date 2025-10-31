<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticket;

final class CreateTicketInterInputDto
{
    public function __construct(
        public readonly int $pkLogement,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $mobile,
        public readonly string $objet,
        public readonly string $message,
        public readonly string $attachmentName,
        public readonly string $attachmentContent,
    ) {}
}
