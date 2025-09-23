<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\GestionParc\ExportAnomaliesOutputDto;
use App\Application\Dto\Output\GestionParc\ExportDysfunctionsOutputDto;
use App\Application\Dto\Output\GestionParc\ExportInterventionsOutputDto;
use App\Application\Dto\Output\GestionParc\ExportLeaksOutputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Application\Dto\Output\GestionParc\ReportOutputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;

final class GestionParcTransformer
{
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
   public function transformExportDysfunctions(array $response): ExportDysfunctionsOutputDto
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
   * Transform raw SOAP response to FilterResultOutputDto
   */
   public function transformFilterResultResponse(array $response): FilterResultOutputDto
   {
      return new FilterResultOutputDto();
   }

   /**
   * Transform raw SOAP response to IndexOutputDto
   */
   public function transformIndexResponse(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw SOAP response to InterventionOutputDto
   */
   public function transformInterventionResponse(array $response): InterventionOutputDto
   {
      return new InterventionOutputDto();
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
   * Transform raw SOAP response to ReportOutputDto
   */
   public function transformReportResponse(array $response): ReportOutputDto
   {
      return new ReportOutputDto();
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

}