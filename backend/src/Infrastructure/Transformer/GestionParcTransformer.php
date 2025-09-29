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
   * Transform raw response to FilterResultOutputDto
   */
   public function transformFilterResult(array $response): FilterResultOutputDto
   {
      return new FilterResultOutputDto();
   }

   /**
   * Transform raw response to IndexOutputDto
   */
   public function transformIndex(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw response to InterventionOutputDto
   */
   public function transformIntervention(array $response): InterventionOutputDto
   {
      return new InterventionOutputDto();
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
   * Transform raw response to ReportOutputDto
   */
   public function transformReport(array $response): ReportOutputDto
   {
      return new ReportOutputDto();
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

}