<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Application\Dto\Output\Ticketing\CheckTicketsInterEnabledOutputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketInterOutputDto;
use App\Application\Dto\Output\Ticketing\GetNbTicketsIntersUserOutputDto;
use App\Application\Dto\Output\Ticketing\GetTicketInterInitOutputDto;
use App\Application\Dto\Output\Ticketing\TicketInterInitDto;
use App\Application\Dto\Output\Ticketing\GetTicketsIntersUserOutputDto;
use App\Application\Dto\Output\Ticketing\TicketInterDto;
use App\Application\Dto\Output\Ticketing\SetTicketStatusOutputDto;

final class TicketingTransformer
{
   public function transformCheckTicketsInterEnabled(object $dataSourceResult): CheckTicketsInterEnabledOutputDto
   {
      return new CheckTicketsInterEnabledOutputDto((bool) $dataSourceResult->CheckTicketsInterEnabledResult);
   }

   public function transformCreateTicketInter(object $dataSourceResult): CreateTicketInterOutputDto
   {
      return new CreateTicketInterOutputDto((int) $dataSourceResult->CreateTicketInterResult);
   }

   public function transformGetAttachment(object $dataSourceResult): AttachmentTicketOutputDto
   {
      // Placeholder: depends on actual attachment structure; return empty list for now
      return new AttachmentTicketOutputDto([]);
   }

   public function transformGetTicketInterInit(object $dataSourceResult): GetTicketInterInitOutputDto
   {
      $s = $dataSourceResult->GetTicketInterInitResult;
      $dto = new TicketInterInitDto(
         fkLogement: (int) $s->FkLogement,
         nom: (string) $s->Nom,
         email: (string) $s->Email,
         telFixe: (string) $s->TelFixe,
         telMobile: (string) $s->TelMobile
      );
      return new GetTicketInterInitOutputDto($dto);
   }

   public function transformGetTicketsIntersUser(object $dataSourceResult): GetTicketsIntersUserOutputDto
   {
      $tickets = [];
      $src = $dataSourceResult->GetTicketsIntersUserResult;
      if (isset($src->ListeTicketsInter) && is_array($src->ListeTicketsInter)) {
         foreach ($src->ListeTicketsInter as $t) {
            $tickets[] = new TicketInterDto(
               id: (int) ($t->Id ?? 0),
               status: (string) ($t->Status ?? ''),
               createdAt: (string) ($t->CreatedAt ?? ''),
               title: (string) ($t->Title ?? '')
            );
         }
      }
      return new GetTicketsIntersUserOutputDto($tickets);
   }

   public function transformSetTicketStatus(object $dataSourceResult): SetTicketStatusOutputDto
   {
      return new SetTicketStatusOutputDto((bool) $dataSourceResult->SetTicketStatusResult);
   }

   public function transformGetNbTicketsIntersUser(object $dataSourceResult): GetNbTicketsIntersUserOutputDto
   {
      return new GetNbTicketsIntersUserOutputDto((int) $dataSourceResult->GetNbTicketsIntersUserResult);
   }
}
