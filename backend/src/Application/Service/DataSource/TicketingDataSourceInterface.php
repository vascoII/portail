<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketInterInitInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketsIntersUserInputDto;
use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;

interface TicketingDataSourceInterface
{

//  public function fetchAttachmentTicket(AttachmentTicketInputDto $inputDto): object;
//  public function fetchCloseTicket(CloseTicketInputDto $inputDto): void;
//  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object;
//  public function fetchMenuTicket(MenuTicketInputDto $inputDto): object;
//  public function fetchTicketList(): object;

  public function fetchCheckTicketsInterEnabled($inputDto): object;
  public function fetchCreateTicketInter(CreateTicketInterInputDto $inputDto): object;
  public function fetchGetAttachment(GetAttachmentInputDto $inputDto): object;
  public function fetchGetTicketInterInit(GetTicketInterInitInputDto $inputDto): object;
	public function fetchGetTicketsIntersUser(GetTicketsIntersUserInputDto $inputDto): object;
	public function fetchSetTicketStatus(SetTicketStatusInputDto $inputDto): object;
	public function fetchGetNbTicketsIntersUser(): object;

}
