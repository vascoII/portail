<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class TableTicketingUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(TableTicketingInputDto $inputDto): TableTicketingOutputDto
  {
    return $this->serviceDataProvider->tableTicketingService($inputDto);
  }
}
