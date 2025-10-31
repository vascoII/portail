<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Ticket\CreateTicketInterInputDto;

interface TicketDataSourceInterface
{
    public function fetchCreateTicket(CreateTicketInterInputDto $inputDto): object;

    public function fetchListTickets(): object;

    public function fetchPatchTicket(GetByIdIntInputDto $inputDto): object;
}
