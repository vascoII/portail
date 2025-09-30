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
    * Transform raw response to FilterResultOutputDto
    */
   public function transformFilterResult(object $dataSourceResult): FilterResultOutputDto
   {
      return new FilterResultOutputDto();
   }

   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $dataSourceResult): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
    * Transform raw response to InterventionOutputDto
    */
   public function transformIntervention(object $dataSourceResult): InterventionOutputDto
   {
      return new InterventionOutputDto();
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
    * Transform raw response to ReportOutputDto
    */
   public function transformReport(object $dataSourceResult): ReportOutputDto
   {
      return new ReportOutputDto();
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
}
