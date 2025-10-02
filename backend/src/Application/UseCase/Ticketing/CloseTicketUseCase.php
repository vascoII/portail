<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class CloseTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CloseTicketInputDto $inputDto): CloseTicketOutputDto
  {
    return $this->serviceDataProvider->closeTicketService($inputDto);
  }
}
