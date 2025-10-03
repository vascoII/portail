<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDepannagesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Service\Transformer\GestionParcTransformerInterface;
use App\Application\Factory\GestionParc\GestionParcEntityFactory;
use App\Application\Factory\GestionParc\GestionParcOutputFactory;

final class GestionParcTransformer implements GestionParcTransformerInterface
{
   public function __construct(
      private readonly GestionParcEntityFactory $entityFactory,
      private readonly GestionParcOutputFactory $outputFactory
   ) {}

   
   /**
    * Transform raw response to FilterResultOutputDto
    */
   public function transformFilterResult(object $dataSourceResult): GetInfosImmeublesOutputDto
   {
      return new GetInfosImmeublesOutputDto();
   }

   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $dataSourceResult): GetTableauBordClientOutputDto
   {
      return new GetTableauBordClientOutputDto();
   }

   /**
    * Transform raw response to InterventionOutputDto
    */
   public function transformIntervention(object $dataSourceResult): GetReportOutputDto
   {
      return new GetReportOutputDto();
   }

   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $dataSourceResult): GetInfosAnomaliesByImmeubleOutputDto
   {
      return new GetInfosAnomaliesByImmeubleOutputDto();
   }

   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $dataSourceResult): GetInfosDysfonctionnementsByImmeubleOutputDto
   {
      return new GetInfosDysfonctionnementsByImmeubleOutputDto();
   }

   /**
    * Transform raw response to ListInterventionsOutputDto
    */
   public function transformListInterventions(object $dataSourceResult): GetInfosDepannagesByImmeubleOutputDto
   {
      return new GetInfosDepannagesByImmeubleOutputDto();
   }

   /**
    * Transform raw response to ListLeaksOutputDto
    */
   public function transformListLeaks(object $dataSourceResult): GetInfosFuitesByImmeubleOutputDto
   {
      return new GetInfosFuitesByImmeubleOutputDto();
   }

   /**
    * Transform raw response to ReportOutputDto
    */
   public function transformReport(object $dataSourceResult): GetReportOutputDto
   {
      return new GetReportOutputDto();
   }

   /**
    * Transform raw response to ShowInterventionOutputDto
    */
   public function transformShowIntervention(object $dataSourceResult): GetInfosDepannagesByImmeubleOutputDto
   {
      return new GetInfosDepannagesByImmeubleOutputDto();
   }

   /**
    * Transform raw response to ShowOutputDto
    */
   public function transformShow(object $dataSourceResult): GetTableauBordImmeubleOutputDto
   {
      return new GetTableauBordImmeubleOutputDto();
   }
}
