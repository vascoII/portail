<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;
use App\Application\Dto\Output\Ticketing\SetTicketStatusOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class CloseTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(SetTicketStatusInputDto $inputDto): SetTicketStatusOutputDto
  {
    return $this->serviceDataProvider->closeTicketService($inputDto);
  }
}
