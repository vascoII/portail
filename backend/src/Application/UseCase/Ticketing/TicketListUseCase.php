<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Output\Ticketing\GetTicketsIntersUserOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class TicketListUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetTicketsIntersUserOutputDto
  {
    return $this->serviceDataProvider->ticketListService();
  }
}
