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
   * Transform raw SOAP response to AttachmentTicketOutputDto
   */
   public function transformAttachmentTicketResponse(array $response): AttachmentTicketOutputDto
   {
      return new AttachmentTicketOutputDto();
   }

   /**
   * Transform raw SOAP response to CloseTicketOutputDto
   */
   public function transformCloseTicketResponse(array $response): CloseTicketOutputDto
   {
      return new CloseTicketOutputDto();
   }

   /**
   * Transform raw SOAP response to CreateTicketOutputDto
   */
   public function transformCreateTicketResponse(array $response): CreateTicketOutputDto
   {
      return new CreateTicketOutputDto();
   }

   /**
   * Transform raw SOAP response to MenuTicketOutputDto
   */
   public function transformMenuTicketResponse(array $response): MenuTicketOutputDto
   {
      return new MenuTicketOutputDto();
   }

   /**
   * Transform raw SOAP response to TableTicketingOutputDto
   */
   public function transformTableTicketingResponse(array $response): TableTicketingOutputDto
   {
      return new TableTicketingOutputDto();
   }

   /**
   * Transform raw SOAP response to TicketListOutputDto
   */
   public function transformTicketListResponse(array $response): TicketListOutputDto
   {
      return new TicketListOutputDto();
   }

}