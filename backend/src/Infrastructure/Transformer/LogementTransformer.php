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
   * Transform raw SOAP response to CreateTicketImmeubleOutputDto
   */
   public function transformCreateTicketImmeubleResponse(array $response): CreateTicketImmeubleOutputDto
   {
      return new CreateTicketImmeubleOutputDto();
   }

   /**
   * Transform raw SOAP response to CreateTicketOutputDto
   */
   public function transformCreateTicketResponse(array $response): CreateTicketOutputDto
   {
      return new CreateTicketOutputDto();
   }

   /**
   * Transform raw SOAP response to EditOutputDto
   */
   public function transformEditResponse(array $response): EditOutputDto
   {
      return new EditOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportAnomaliesOutputDto
   */
   public function transformExportAnomaliesResponse(array $response): ExportAnomaliesOutputDto
   {
      return new ExportAnomaliesOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportDysfunctionsOutputDto
   */
   public function transformExportDysfunctionsResponse(array $response): ExportDysfunctionsOutputDto
   {
      return new ExportDysfunctionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportInterventionsOutputDto
   */
   public function transformExportInterventionsResponse(array $response): ExportInterventionsOutputDto
   {
      return new ExportInterventionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportLeaksOutputDto
   */
   public function transformExportLeaksResponse(array $response): ExportLeaksOutputDto
   {
      return new ExportLeaksOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportOutputDto
   */
   public function transformExportResponse(array $response): ExportOutputDto
   {
      return new ExportOutputDto();
   }

   /**
   * Transform raw SOAP response to FilterResultOutputDto
   */
   public function transformFilterResultResponse(array $response): FilterResultOutputDto
   {
      return new FilterResultOutputDto();
   }

   /**
   * Transform raw SOAP response to GetInfosAppareilOutputDto
   */
   public function transformGetInfosAppareilResponse(array $response): GetInfosAppareilOutputDto
   {
      return new GetInfosAppareilOutputDto();
   }

   /**
   * Transform raw SOAP response to GetTicketOnwerOutputDto
   */
   public function transformGetTicketOnwerResponse(array $response): GetTicketOnwerOutputDto
   {
      return new GetTicketOnwerOutputDto();
   }

   /**
   * Transform raw SOAP response to GuideOutputDto
   */
   public function transformGuideResponse(array $response): GuideOutputDto
   {
      return new GuideOutputDto();
   }

   /**
   * Transform raw SOAP response to IndexOutputDto
   */
   public function transformIndexResponse(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw SOAP response to ListAnomaliesOutputDto
   */
   public function transformListAnomaliesResponse(array $response): ListAnomaliesOutputDto
   {
      return new ListAnomaliesOutputDto();
   }

   /**
   * Transform raw SOAP response to ListDysfunctionsOutputDto
   */
   public function transformListDysfunctionsResponse(array $response): ListDysfunctionsOutputDto
   {
      return new ListDysfunctionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ListInterventionsOutputDto
   */
   public function transformListInterventionsResponse(array $response): ListInterventionsOutputDto
   {
      return new ListInterventionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ListLeaksOutputDto
   */
   public function transformListLeaksResponse(array $response): ListLeaksOutputDto
   {
      return new ListLeaksOutputDto();
   }

   /**
   * Transform raw SOAP response to SearchOutputDto
   */
   public function transformSearchResponse(array $response): SearchOutputDto
   {
      return new SearchOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowInterventionOutputDto
   */
   public function transformShowInterventionResponse(array $response): ShowInterventionOutputDto
   {
      return new ShowInterventionOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowOutputDto
   */
   public function transformShowResponse(array $response): ShowOutputDto
   {
      return new ShowOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowRepartReleveOutputDto
   */
   public function transformShowRepartReleveResponse(array $response): ShowRepartReleveOutputDto
   {
      return new ShowRepartReleveOutputDto();
   }

}