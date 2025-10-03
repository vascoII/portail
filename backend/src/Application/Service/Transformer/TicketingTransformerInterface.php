<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Ticketing\GetAttachmentOutputDto;
use App\Application\Dto\Output\Ticketing\CheckTicketsInterEnabledOutputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketInterOutputDto;
use App\Application\Dto\Output\Ticketing\GetNbTicketsIntersUserOutputDto;
use App\Application\Dto\Output\Ticketing\GetTicketInterInitOutputDto;
use App\Application\Dto\Output\Ticketing\GetTicketsIntersUserOutputDto;
use App\Application\Dto\Output\Ticketing\SetTicketStatusOutputDto;

interface TicketingTransformerInterface
{
   public function transformCheckTicketsInterEnabled(object $dataSourceResult): CheckTicketsInterEnabledOutputDto;


   public function transformCreateTicketInter(object $dataSourceResult): CreateTicketInterOutputDto;
   

   public function transformGetAttachment(object $dataSourceResult): GetAttachmentOutputDto;
   
   public function transformGetTicketInterInit(object $dataSourceResult): GetTicketInterInitOutputDto;
   

   public function transformGetTicketsIntersUser(object $dataSourceResult): GetTicketsIntersUserOutputDto;
   

   public function transformSetTicketStatus(object $dataSourceResult): SetTicketStatusOutputDto;
   

   public function transformGetNbTicketsIntersUser(object $dataSourceResult): GetNbTicketsIntersUserOutputDto;
   
}
