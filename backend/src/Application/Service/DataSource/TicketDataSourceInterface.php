<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface TicketDataSourceInterface
{
  public function fetchListTickets(): object;
  public function fetchGetTicket(GetByIdIntInputDto $inputDto): object;
  public function fetchCreateTicket(GetByIdIntInputDto $inputDto): object;
  public function fetchPatchTicket(GetByIdIntInputDto $inputDto): object;
}
