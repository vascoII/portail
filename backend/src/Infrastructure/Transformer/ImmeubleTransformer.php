<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosLogementsByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOutputDto;

final class ImmeubleTransformer
{
   /**
    * Transform raw response to GetTableauBordImmeubleOutputDto
    */
   public function transformGetTableauBordImmeuble(object $dataSourceResult): GetTableauBordImmeubleOutputDto
   {
      $result = $dataSourceResult->GetTableauBordImmeubleResult;
      return new GetTableauBordImmeubleOutputDto($result);
   }

   /**
    * Transform raw response to GetInfosAnomaliesByImmeubleOutputDto
    */
   public function transformGetInfosAnomaliesByImmeuble(object $dataSourceResult): GetInfosAnomaliesByImmeubleOutputDto
   {
      $result = $dataSourceResult->GetInfosAnomaliesByImmeubleResult;
      return new GetInfosAnomaliesByImmeubleOutputDto($result);
   }

   /**
    * Transform raw response to GetInfosDysfonctionnementsByImmeubleOutputDto
    */
   public function transformGetInfosDysfonctionnementsByImmeuble(object $dataSourceResult): GetInfosDysfonctionnementsByImmeubleOutputDto
   {
      $result = $dataSourceResult->GetInfosDysfonctionnementsByImmeubleResult;
      return new GetInfosDysfonctionnementsByImmeubleOutputDto($result);
   }

   /**
    * Transform raw response to GetInfosImmeublesOutputDto
    */
   public function transformGetInfosImmeubles(object $dataSourceResult): GetInfosImmeublesOutputDto
   {
      $result = $dataSourceResult->GetInfosImmeublesResult;
      return new GetInfosImmeublesOutputDto($result);
   }

   /**
    * Transform raw response to GetInfosLogementsByImmeubleOutputDto
    */
   public function transformGetInfosLogementsByImmeuble(object $dataSourceResult): GetInfosLogementsByImmeubleOutputDto
   {
      $result = $dataSourceResult->GetInfosLogementsByImmeubleResult;
      return new GetInfosLogementsByImmeubleOutputDto($result);
   }

   /**
    * Transform raw response to GetInfosDepannagesByImmeubleOutputDto
    */
   public function transformGetInfosDepannagesByImmeuble(object $dataSourceResult): object
   {
      return $dataSourceResult->GetInfosDepannagesByImmeubleResult;
   }

   /**
    * Transform raw response to GetInfosFuitesByImmeubleOutputDto
    */
   public function transformGetInfosFuitesByImmeuble(object $dataSourceResult): object
   {
      return $dataSourceResult->GetInfosFuitesByImmeubleResult;
   }

   // List methods for when we need simple arrays
   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOutputDto
   {
      $anomalies = [];
      if (is_array($dataSourceResult->GetInfosAnomaliesByImmeubleResult->ListeInfosAnomalies)) {
         foreach ($dataSourceResult->GetInfosAnomaliesByImmeubleResult->ListeInfosAnomalies as $anomalie) {
            $anomalies[] = $anomalie;
         }
      }
      return new ListAnomaliesOutputDto($anomalies);
   }

   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $dataSourceResult): ListDysfunctionsOutputDto
   {
      $dysfunctions = [];
      if (is_array($dataSourceResult->GetInfosDysfonctionnementsByImmeubleResult->ListeInfosDysfonctionnements)) {
         foreach ($dataSourceResult->GetInfosDysfonctionnementsByImmeubleResult->ListeInfosDysfonctionnements as $dysfunction) {
            $dysfunctions[] = $dysfunction;
         }
      }
      return new ListDysfunctionsOutputDto($dysfunctions);
   }

   /**
    * Transform raw response to ListImmeublesOutputDto
    */
   public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto
   {
      $immeubles = [];
      if (is_array($dataSourceResult->GetInfosImmeublesResult->ListeInfosImmeubles)) {
         foreach ($dataSourceResult->GetInfosImmeublesResult->ListeInfosImmeubles as $immeuble) {
            $immeubles[] = $immeuble;
         }
      }
      return new ListImmeublesOutputDto($immeubles);
   }

   /**
    * Transform raw response to ListLogementsOutputDto
    */
   public function transformListLogements(object $dataSourceResult): ListLogementsOutputDto
   {
      $logements = [];
      if (is_array($dataSourceResult->GetInfosLogementsByImmeubleResult->ListeInfosLogements)) {
         foreach ($dataSourceResult->GetInfosLogementsByImmeubleResult->ListeInfosLogements as $logement) {
            $logements[] = $logement;
         }
      }
      return new ListLogementsOutputDto($logements);
   }
}
