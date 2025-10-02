<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Output\Ticketing\GetAttachmentOutputDto;
use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;
use App\Application\Dto\Output\Ticketing\SetTicketStatusOutputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketInterOutputDto;
use App\Application\Dto\Output\Ticketing\GetTicketsIntersUserOutputDto;

interface TicketingDataProviderInterface
{

  public function attachmentTicketService(GetAttachmentInputDto $inputDto): GetAttachmentOutputDto;
  public function closeTicketService(SetTicketStatusInputDto $inputDto): SetTicketStatusOutputDto;
  public function createTicketService(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto;
  public function ticketListService(): GetTicketsIntersUserOutputDto;
}
