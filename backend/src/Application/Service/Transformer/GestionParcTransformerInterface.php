<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDepannagesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;

interface GestionParcTransformerInterface
{
   /**
    * Transform raw response to FilterResultOutputDto
    */
   public function transformFilterResult(object $dataSourceResult): GetInfosImmeublesOutputDto;
   

   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $dataSourceResult): GetTableauBordClientOutputDto;
   
   /**
    * Transform raw response to InterventionOutputDto
    */
   public function transformIntervention(object $dataSourceResult): GetReportOutputDto;
   
   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $dataSourceResult): GetInfosAnomaliesByImmeubleOutputDto;
   
   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $dataSourceResult): GetInfosDysfonctionnementsByImmeubleOutputDto;
   

   /**
    * Transform raw response to ListInterventionsOutputDto
    */
   public function transformListInterventions(object $dataSourceResult): GetInfosDepannagesByImmeubleOutputDto;
   

   /**
    * Transform raw response to ListLeaksOutputDto
    */
   public function transformListLeaks(object $dataSourceResult): GetInfosFuitesByImmeubleOutputDto;
  
   /**
    * Transform raw response to ReportOutputDto
    */
   public function transformReport(object $dataSourceResult): GetReportOutputDto;
   

   /**
    * Transform raw response to ShowInterventionOutputDto
    */
   public function transformShowIntervention(object $dataSourceResult): GetInfosDepannagesByImmeubleOutputDto;
   

   /**
    * Transform raw response to ShowOutputDto
    */
   public function transformShow(object $dataSourceResult): GetTableauBordImmeubleOutputDto;
   
}
