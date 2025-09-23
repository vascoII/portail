<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;

interface TicketingSoapInterface
{

  public function attachmentTicketService(AttachmentTicketInputDto $inputDto): array;
  public function closeTicketService(CloseTicketInputDto $inputDto): array;
  public function createTicketService(CreateTicketInputDto $inputDto): array;
  public function menuTicketService(MenuTicketInputDto $inputDto): array;
  public function tableTicketingService(TableTicketingInputDto $inputDto): array;
  public function ticketListService(TicketListInputDto $inputDto): array;
}
