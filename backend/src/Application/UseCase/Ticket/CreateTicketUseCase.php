<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticket;

use App\Application\Dto\Input\Ticket\CreateTicketInterInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\TicketDataProviderInterface;

final class CreateTicketUseCase
{
  public function __construct(
    private readonly TicketDataProviderInterface $dataProvider
  ) {}

  public function execute(CreateTicketInterInputDto $inputDto): SuccessOutputDto
  {
    return $this->dataProvider->createTicketService($inputDto);
  }
}
