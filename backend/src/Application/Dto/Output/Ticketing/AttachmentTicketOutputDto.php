<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class AttachmentTicketOutputDto
{
  public function __construct(public readonly array $attachments) {}
}
