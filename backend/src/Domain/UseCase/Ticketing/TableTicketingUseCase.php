<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class TableTicketingUseCase implements UseCaseInterface
{
  public function __construct(private readonly TicketingSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof TableTicketingInputDto);
    return new TableTicketingOutputDto([]);
  }
}
