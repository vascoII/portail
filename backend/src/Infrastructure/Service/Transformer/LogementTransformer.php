<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOutputDto;
use App\Application\Dto\Output\Logement\GetLogementOutputDto;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Factory\Logement\LogementEntityFactory;
use App\Application\Factory\Logement\LogementOutputFactory;
use App\Application\Dto\Output\Logement\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Logement\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Logement\ListFuitesOuputDto;
use App\Application\Dto\Output\Logement\ListInternetionsOutputDto;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;

final class LogementTransformer implements LogementTransformerInterface
{
   public function __construct(
      private readonly LogementEntityFactory $entityFactory,
      private readonly LogementOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to ListLogementsOutputDto
    */
   public function transformListLogements(object $dataSourceResult): ListLogementsOutputDto
   {
      $logementsRaw = is_array($rawLogement = $dataSourceResult->ListeInfosLogements->infosLogement ?? null) ?
         $rawLogement : ($rawLogement ? [$rawLogement] : []);

      $entities = $this->entityFactory->createManyLogementsFromRawList($logementsRaw);

      return $this->outputFactory->createListLogements($entities);
   }

   public function transformGetLogement(object $dataSourceResult): GetLogementOutputDto
   {
      $entity = $this->entityFactory->createLogementFromRaw($dataSourceResult);
      return $this->outputFactory->createGetLogement($entity);
   }

   public function transformListAnomaliesByLogement(object $dataSourceResult): ListAnomaliesOuputDto {}

   public function transformListDysfonctionnementsByLogement(object $dataSourceResult): ListDysfonctionnementsOuputDto {}

   public function transformListFuitesByLogement(object $dataSourceResult): ListFuitesOuputDto {}

   public function transformListInterventionsByLogement(object $dataSourceResult): ListInternetionsOutputDto
   {
      $interventionsRaw = is_array($rawIntervention = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ?
         $rawIntervention : ($rawIntervention ? [$rawIntervention] : []);

      $entities = $this->entityFactory->createManyInterventionsFromRawList($interventionsRaw);

      return $this->outputFactory->createListInterventionsByLogement($entities);
   }

   public function transformListLogementsByLogement(object $dataSourceResult): ListLogementsOuputDto {}
}
