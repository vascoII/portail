<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class CreateTicketUseCase implements UseCaseInterface
{
  public function __construct(private readonly TicketingSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof CreateTicketInputDto);
    return new CreateTicketOutputDto('TICKET-NEW-ID');
  }
}
