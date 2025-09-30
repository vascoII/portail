<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Logement\CreateTicketImmeubleOutputDto;
use App\Application\Dto\Output\Logement\CreateTicketOutputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;
use App\Application\Dto\Output\Logement\ExportAnomaliesOutputDto;
use App\Application\Dto\Output\Logement\ExportDysfunctionsOutputDto;
use App\Application\Dto\Output\Logement\ExportInterventionsOutputDto;
use App\Application\Dto\Output\Logement\ExportLeaksOutputDto;
use App\Application\Dto\Output\Logement\ExportOutputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilOutputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;
use App\Application\Dto\Output\Logement\GuideOutputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Application\Dto\Output\Logement\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Application\Dto\Output\Logement\ShowInterventionOutputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;

final class LogementTransformer
{
   /**
    * Transform raw response to CreateTicketImmeubleOutputDto
    */
   public function transformCreateTicketImmeuble(object $dataSourceResult): CreateTicketImmeubleOutputDto
   {
      return new CreateTicketImmeubleOutputDto();
   }

   /**
    * Transform raw response to CreateTicketOutputDto
    */
   public function transformCreateTicket(object $dataSourceResult): CreateTicketOutputDto
   {
      return new CreateTicketOutputDto();
   }

   /**
    * Transform raw response to EditOutputDto
    */
   public function transformEdit(object $dataSourceResult): EditOutputDto
   {
      return new EditOutputDto();
   }

   /**
    * Transform raw response to ExportAnomaliesOutputDto
    */
   public function transformExportAnomalies(object $dataSourceResult): ExportAnomaliesOutputDto
   {
      return new ExportAnomaliesOutputDto();
   }

   /**
    * Transform raw response to ExportDysfunctionsOutputDto
    */
   public function transformExportDysfunctions(object $dataSourceResult): ExportDysfunctionsOutputDto
   {
      return new ExportDysfunctionsOutputDto();
   }

   /**
    * Transform raw response to ExportInterventionsOutputDto
    */
   public function transformExportInterventions(object $dataSourceResult): ExportInterventionsOutputDto
   {
      return new ExportInterventionsOutputDto();
   }

   /**
    * Transform raw response to ExportLeaksOutputDto
    */
   public function transformExportLeaks(object $dataSourceResult): ExportLeaksOutputDto
   {
      return new ExportLeaksOutputDto();
   }

   /**
    * Transform raw response to ExportOutputDto
    */
   public function transformExport(object $dataSourceResult): ExportOutputDto
   {
      return new ExportOutputDto();
   }

   /**
    * Transform raw response to FilterResultOutputDto
    */
   public function transformFilterResult(object $dataSourceResult): FilterResultOutputDto
   {
      return new FilterResultOutputDto();
   }

   /**
    * Transform raw response to GetInfosAppareilOutputDto
    */
   public function transformGetInfosAppareil(object $dataSourceResult): GetInfosAppareilOutputDto
   {
      return new GetInfosAppareilOutputDto();
   }

   /**
    * Transform raw response to GetTicketOnwerOutputDto
    */
   public function transformGetTicketOnwer(object $dataSourceResult): GetTicketOnwerOutputDto
   {
      return new GetTicketOnwerOutputDto();
   }

   /**
    * Transform raw response to GuideOutputDto
    */
   public function transformGuide(object $dataSourceResult): GuideOutputDto
   {
      return new GuideOutputDto();
   }

   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $dataSourceResult): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOutputDto
   {
      return new ListAnomaliesOutputDto();
   }

   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $dataSourceResult): ListDysfunctionsOutputDto
   {
      return new ListDysfunctionsOutputDto();
   }

   /**
    * Transform raw response to ListInterventionsOutputDto
    */
   public function transformListInterventions(object $dataSourceResult): ListInterventionsOutputDto
   {
      return new ListInterventionsOutputDto();
   }

   /**
    * Transform raw response to ListLeaksOutputDto
    */
   public function transformListLeaks(object $dataSourceResult): ListLeaksOutputDto
   {
      return new ListLeaksOutputDto();
   }

   /**
    * Transform raw response to SearchOutputDto
    */
   public function transformSearch(object $dataSourceResult): SearchOutputDto
   {
      return new SearchOutputDto();
   }

   /**
    * Transform raw response to ShowInterventionOutputDto
    */
   public function transformShowIntervention(object $dataSourceResult): ShowInterventionOutputDto
   {
      return new ShowInterventionOutputDto();
   }

   /**
    * Transform raw response to ShowOutputDto
    */
   public function transformShow(object $dataSourceResult): ShowOutputDto
   {
      return new ShowOutputDto();
   }

   /**
    * Transform raw response to ShowRepartReleveOutputDto
    */
   public function transformShowRepartReleve(object $dataSourceResult): ShowRepartReleveOutputDto
   {
      return new ShowRepartReleveOutputDto();
   }
}
