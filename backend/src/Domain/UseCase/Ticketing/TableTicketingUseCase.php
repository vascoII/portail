<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;

use App\Domain\Service\Soap\TicketingSoapInterface;

final class TableTicketingUseCase
{
  public function __construct(private readonly TicketingSoapInterface $service) {}

  public function execute(TableTicketingInputDto $inputDto): TableTicketingOutputDto
  {
    \assert($inputDto instanceof TableTicketingInputDto);
    return new TableTicketingOutputDto([]);
  }
}
