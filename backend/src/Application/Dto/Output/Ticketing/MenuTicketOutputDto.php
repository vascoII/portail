<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class MenuTicketOutputDto
{
  public function __construct(public readonly array $items) {}
}
