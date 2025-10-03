<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosLogementsByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOutputDto;

interface ImmeubleTransformerInterface
{
   /**
    * Transform raw response to GetTableauBordImmeubleOutputDto
    */
   public function transformGetTableauBordImmeuble(object $dataSourceResult): GetTableauBordImmeubleOutputDto;
   

   /**
    * Transform raw response to GetInfosAnomaliesByImmeubleOutputDto
    */
   public function transformGetInfosAnomaliesByImmeuble(object $dataSourceResult): GetInfosAnomaliesByImmeubleOutputDto;
  

   /**
    * Transform raw response to GetInfosDysfonctionnementsByImmeubleOutputDto
    */
   public function transformGetInfosDysfonctionnementsByImmeuble(object $dataSourceResult): GetInfosDysfonctionnementsByImmeubleOutputDto;
   

   /**
    * Transform raw response to GetInfosImmeublesOutputDto
    */
   public function transformGetInfosImmeubles(object $dataSourceResult): GetInfosImmeublesOutputDto;
  

   /**
    * Transform raw response to GetInfosLogementsByImmeubleOutputDto
    */
   public function transformGetInfosLogementsByImmeuble(object $dataSourceResult): GetInfosLogementsByImmeubleOutputDto;
  

   /**
    * Transform raw response to GetInfosDepannagesByImmeubleOutputDto
    */
   public function transformGetInfosDepannagesByImmeuble(object $dataSourceResult): object;
   
   /**
    * Transform raw response to GetInfosFuitesByImmeubleOutputDto
    */
   public function transformGetInfosFuitesByImmeuble(object $dataSourceResult): object;
   

   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOutputDto;
  

   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $dataSourceResult): ListDysfunctionsOutputDto;
   
   /**
    * Transform raw response to ListImmeublesOutputDto
    */
   public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto;
  

   /**
    * Transform raw response to ListLogementsOutputDto
    */
   public function transformListLogements(object $dataSourceResult): ListLogementsOutputDto;
  
}
