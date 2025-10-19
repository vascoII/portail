<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface TicketTransformerInterface
{
  public function transformListTickets(object $dataSourceResult): SuccessOutputDto;
  public function transformGetTicket(object $dataSourceResult): SuccessOutputDto;
  public function transformCreateTicket(object $dataSourceResult): SuccessOutputDto;
  public function transformPatchTicket(object $dataSourceResult): SuccessOutputDto;
}
