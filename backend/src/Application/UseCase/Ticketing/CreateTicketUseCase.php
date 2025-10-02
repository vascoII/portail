<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketInterOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class CreateTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto
  {
    return $this->serviceDataProvider->createTicketService($inputDto);
  }
}
