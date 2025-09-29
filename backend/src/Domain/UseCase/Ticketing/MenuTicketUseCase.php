<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class MenuTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(MenuTicketInputDto $inputDto): MenuTicketOutputDto
  {
    return $this->serviceDataProvider->menuTicketService($inputDto);
  }
}
