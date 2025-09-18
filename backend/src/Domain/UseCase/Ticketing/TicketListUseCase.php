<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class TicketListUseCase implements UseCaseInterface
{
  public function __construct(private readonly TicketingSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof TicketListInputDto);
    return new TicketListOutputDto([]);
  }
}
