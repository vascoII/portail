<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Immeuble\ExportAnomaliesOutputDto;
use App\Application\Dto\Output\Immeuble\ExportDysfunctionsOutputDto;
use App\Application\Dto\Output\Immeuble\ExportInterventionsOutputDto;
use App\Application\Dto\Output\Immeuble\ExportLeaksOutputDto;
use App\Application\Dto\Output\Immeuble\FilterResultOutputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Application\Dto\Output\Immeuble\InterventionOutputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListLeaksOutputDto;
use App\Application\Dto\Output\Immeuble\ReportOutputDto;
use App\Application\Dto\Output\Immeuble\ShowInterventionOutputDto;
use App\Application\Dto\Output\Immeuble\ShowOutputDto;

final class ImmeubleTransformer
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