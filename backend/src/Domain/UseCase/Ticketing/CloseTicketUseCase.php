<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;

use App\Domain\Service\Soap\TicketingSoapInterface;

final class CloseTicketUseCase
{
  public function __construct(private readonly TicketingSoapInterface $service) {}

  public function execute(CloseTicketInputDto $inputDto): CloseTicketOutputDto
  {
    return $this->service->closeTicketService($inputDto);
  }
}
