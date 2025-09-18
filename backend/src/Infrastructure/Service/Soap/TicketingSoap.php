<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class TicketingSoap implements TicketingSoapInterface
{
  public function attachmentTicketService(AttachmentTicketInputDto $inputDto): AttachmentTicketOutputDto
  {
    // TODO: Implement attachmentTicketService logic
    return new AttachmentTicketOutputDto([]);
  }

  public function closeTicketService(CloseTicketInputDto $inputDto): CloseTicketOutputDto
  {
    // TODO: Implement closeTicketService logic
    return new CloseTicketOutputDto(true);
  }

  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    // TODO: Implement createTicketService logic
    return new CreateTicketOutputDto('');
  }

  public function menuTicketService(MenuTicketInputDto $inputDto): MenuTicketOutputDto
  {
    // TODO: Implement menuTicketService logic
    return new MenuTicketOutputDto([]);
  }

  public function tableTicketingService(TableTicketingInputDto $inputDto): TableTicketingOutputDto
  {
    // TODO: Implement tableTicketingService logic
    return new TableTicketingOutputDto([]);
  }

  public function ticketListService(TicketListInputDto $inputDto): TicketListOutputDto
  {
    // TODO: Implement ticketListService logic
    return new TicketListOutputDto([]);
  }
}
