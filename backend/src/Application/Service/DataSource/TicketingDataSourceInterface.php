<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;

interface TicketingDataSourceInterface
{

  public function fetchAttachmentTicket(AttachmentTicketInputDto $inputDto): object;
  public function fetchCloseTicket(CloseTicketInputDto $inputDto): object;
  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object;
  public function fetchMenuTicket(MenuTicketInputDto $inputDto): object;
  public function fetchTableTicketing(TableTicketingInputDto $inputDto): object;
  public function fetchTicketList(TicketListInputDto $inputDto): object;
}
