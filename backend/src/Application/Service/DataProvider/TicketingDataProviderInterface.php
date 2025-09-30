<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;

interface TicketingDataProviderInterface
{

  public function attachmentTicketService(AttachmentTicketInputDto $inputDto): AttachmentTicketOutputDto;
  public function closeTicketService(CloseTicketInputDto $inputDto): CloseTicketOutputDto;
  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto;
  public function menuTicketService(MenuTicketInputDto $inputDto): MenuTicketOutputDto;
  public function ticketListService(): TicketListOutputDto;
}
