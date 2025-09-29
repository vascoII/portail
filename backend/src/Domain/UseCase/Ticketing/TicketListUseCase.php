<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class TicketListUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(TicketListInputDto $inputDto): TicketListOutputDto
  {
    return $this->serviceDataProvider->ticketListService($inputDto);
  }
}
