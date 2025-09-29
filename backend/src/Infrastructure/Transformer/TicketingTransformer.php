<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;

final class TicketingTransformer
{
   /**
   * Transform raw response to AttachmentTicketOutputDto
   */
   public function transformAttachmentTicket(array $response): AttachmentTicketOutputDto
   {
      return new AttachmentTicketOutputDto();
   }

   /**
   * Transform raw response to CloseTicketOutputDto
   */
   public function transformCloseTicket(array $response): CloseTicketOutputDto
   {
      return new CloseTicketOutputDto();
   }

   /**
   * Transform raw response to CreateTicketOutputDto
   */
   public function transformCreateTicket(array $response): CreateTicketOutputDto
   {
      return new CreateTicketOutputDto();
   }

   /**
   * Transform raw response to MenuTicketOutputDto
   */
   public function transformMenuTicket(array $response): MenuTicketOutputDto
   {
      return new MenuTicketOutputDto();
   }

   /**
   * Transform raw response to TableTicketingOutputDto
   */
   public function transformTableTicketing(array $response): TableTicketingOutputDto
   {
      return new TableTicketingOutputDto();
   }

   /**
   * Transform raw response to TicketListOutputDto
   */
   public function transformTicketList(array $response): TicketListOutputDto
   {
      return new TicketListOutputDto();
   }

}