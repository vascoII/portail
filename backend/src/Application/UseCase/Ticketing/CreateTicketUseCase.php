<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class CreateTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    return $this->serviceDataProvider->createTicketService($inputDto);
  }
}
