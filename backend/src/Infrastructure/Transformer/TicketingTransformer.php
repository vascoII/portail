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
   public function transformAttachmentTicket(object $dataSourceResult): AttachmentTicketOutputDto
   {
      return new AttachmentTicketOutputDto();
   }

   /**
    * Transform raw response to CloseTicketOutputDto
    */
   public function transformCloseTicket(object $dataSourceResult): CloseTicketOutputDto
   {
      return new CloseTicketOutputDto();
   }

   /**
    * Transform raw response to CreateTicketOutputDto
    */
   public function transformCreateTicket(object $dataSourceResult): CreateTicketOutputDto
   {
      return new CreateTicketOutputDto();
   }

   /**
    * Transform raw response to MenuTicketOutputDto
    */
   public function transformMenuTicket(object $dataSourceResult): MenuTicketOutputDto
   {
      return new MenuTicketOutputDto();
   }

   /**
    * Transform raw response to TableTicketingOutputDto
    */
   public function transformTableTicketing(object $dataSourceResult): TableTicketingOutputDto
   {
      return new TableTicketingOutputDto();
   }

   /**
    * Transform raw response to TicketListOutputDto
    */
   public function transformTicketList(object $dataSourceResult): TicketListOutputDto
   {
      return new TicketListOutputDto();
   }
}
