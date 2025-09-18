<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;

use App\Domain\Service\Soap\TicketingSoapInterface;

final class CreateTicketUseCase
{
  public function __construct(private readonly TicketingSoapInterface $service) {}

  public function execute(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    return $this->service->createTicketService($inputDto);
  }
}
