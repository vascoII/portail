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
   public function transformCreateTicketImmeuble(array $response): CreateTicketImmeubleOutputDto
   {
      return new CreateTicketImmeubleOutputDto();
   }

   /**
   * Transform raw response to CreateTicketOutputDto
   */
   public function transformCreateTicket(array $response): CreateTicketOutputDto
   {
      return new CreateTicketOutputDto();
   }

   /**
   * Transform raw response to EditOutputDto
   */
   public function transformEdit(array $response): EditOutputDto
   {
      return new EditOutputDto();
   }

   /**
   * Transform raw response to ExportAnomaliesOutputDto
   */
   public function transformExportAnomalies(array $response): ExportAnomaliesOutputDto
   {
      return new ExportAnomaliesOutputDto();
   }

   /**
   * Transform raw response to ExportDysfunctionsOutputDto
   */
   public function transformExportDysfunctions(array $response): ExportDysfunctionsOutputDto
   {
      return new ExportDysfunctionsOutputDto();
   }

   /**
   * Transform raw response to ExportInterventionsOutputDto
   */
   public function transformExportInterventions(array $response): ExportInterventionsOutputDto
   {
      return new ExportInterventionsOutputDto();
   }

   /**
   * Transform raw response to ExportLeaksOutputDto
   */
   public function transformExportLeaks(array $response): ExportLeaksOutputDto
   {
      return new ExportLeaksOutputDto();
   }

   /**
   * Transform raw response to ExportOutputDto
   */
   public function transformExport(array $response): ExportOutputDto
   {
      return new ExportOutputDto();
   }

   /**
   * Transform raw response to FilterResultOutputDto
   */
   public function transformFilterResult(array $response): FilterResultOutputDto
   {
      return new FilterResultOutputDto();
   }

   /**
   * Transform raw response to GetInfosAppareilOutputDto
   */
   public function transformGetInfosAppareil(array $response): GetInfosAppareilOutputDto
   {
      return new GetInfosAppareilOutputDto();
   }

   /**
   * Transform raw response to GetTicketOnwerOutputDto
   */
   public function transformGetTicketOnwer(array $response): GetTicketOnwerOutputDto
   {
      return new GetTicketOnwerOutputDto();
   }

   /**
   * Transform raw response to GuideOutputDto
   */
   public function transformGuide(array $response): GuideOutputDto
   {
      return new GuideOutputDto();
   }

   /**
   * Transform raw response to IndexOutputDto
   */
   public function transformIndex(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw response to ListAnomaliesOutputDto
   */
   public function transformListAnomalies(array $response): ListAnomaliesOutputDto
   {
      return new ListAnomaliesOutputDto();
   }

   /**
   * Transform raw response to ListDysfunctionsOutputDto
   */
   public function transformListDysfunctions(array $response): ListDysfunctionsOutputDto
   {
      return new ListDysfunctionsOutputDto();
   }

   /**
   * Transform raw response to ListInterventionsOutputDto
   */
   public function transformListInterventions(array $response): ListInterventionsOutputDto
   {
      return new ListInterventionsOutputDto();
   }

   /**
   * Transform raw response to ListLeaksOutputDto
   */
   public function transformListLeaks(array $response): ListLeaksOutputDto
   {
      return new ListLeaksOutputDto();
   }

   /**
   * Transform raw response to SearchOutputDto
   */
   public function transformSearch(array $response): SearchOutputDto
   {
      return new SearchOutputDto();
   }

   /**
   * Transform raw response to ShowInterventionOutputDto
   */
   public function transformShowIntervention(array $response): ShowInterventionOutputDto
   {
      return new ShowInterventionOutputDto();
   }

   /**
   * Transform raw response to ShowOutputDto
   */
   public function transformShow(array $response): ShowOutputDto
   {
      return new ShowOutputDto();
   }

   /**
   * Transform raw response to ShowRepartReleveOutputDto
   */
   public function transformShowRepartReleve(array $response): ShowRepartReleveOutputDto
   {
      return new ShowRepartReleveOutputDto();
   }

}