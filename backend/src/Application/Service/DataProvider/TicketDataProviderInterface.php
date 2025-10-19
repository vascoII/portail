<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface TicketDataProviderInterface
{
  public function listTicketsService(): SuccessOutputDto;
  public function getTicketService(GetByIdIntInputDto $inputDto): SuccessOutputDto;
  public function createTicketService(GetByIdIntInputDto $inputDto): SuccessOutputDto;
  public function patchTicketService(GetByIdIntInputDto $inputDto): SuccessOutputDto;
}
