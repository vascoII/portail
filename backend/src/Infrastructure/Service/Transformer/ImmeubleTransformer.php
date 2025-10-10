<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Service\Transformer\ImmeubleTransformerInterface;
use App\Application\Factory\Immeuble\ImmeubleEntityFactory;
use App\Application\Factory\Immeuble\ImmeubleOutputFactory;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Immeuble\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Immeuble\ListFuitesOuputDto;
use App\Application\Dto\Output\Immeuble\ListInternetionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOuputDto;

final class ImmeubleTransformer implements ImmeubleTransformerInterface
{
   public function __construct(
      private readonly ImmeubleEntityFactory $entityFactory,
      private readonly ImmeubleOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to ListImmeublesOutputDto
    */
   public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto
   {
      $immeublesRaw = is_array($rawImmeuble = $dataSourceResult->ListeInfosImmeubles->infosImmeuble ?? null) ? 
         $rawImmeuble : ($rawImmeuble ? [$rawImmeuble] : []);

      $entities = $this->entityFactory->createManyImmeublesFromRawList($immeublesRaw);

      return $this->outputFactory->createListImmeubles($entities);
   }

   public function transformGetImmeuble(object $dataSourceResult): GetImmeubleOutputDto
   {
      $entity = $this->entityFactory->createImmeubleFromRaw($dataSourceResult);
      return $this->outputFactory->createGetImmeuble($entity);
   }

   public function transformListAnomaliesByImmeuble(object $dataSourceResult): ListAnomaliesOuputDto
   {

   }

   public function transformListDysfonctionnementsByImmeuble(object $dataSourceResult): ListDysfonctionnementsOuputDto
   {

   }

   public function transformListFuitesByImmeuble(object $dataSourceResult): ListFuitesOuputDto
   {

   }

   public function transformListInterventionsByImmeuble(object $dataSourceResult): ListInternetionsOutputDto
   {
      $interventionsRaw = is_array($rawIntervention = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ? 
         $rawIntervention : ($rawIntervention ? [$rawIntervention] : []);
         
      $entities = $this->entityFactory->createManyInterventionsFromRawList($interventionsRaw);

      return $this->outputFactory->createListInterventionsByImmeuble($entities);
   }

   public function transformListLogementsByImmeuble(object $dataSourceResult): ListLogementsOuputDto
   {

   }

}
