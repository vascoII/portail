<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Logement\GetInfosLogementsOutputDto;
use App\Application\Dto\Output\Logement\GetOccupants4ChgtOutputDto;
use App\Application\Dto\Output\Logement\GetStatOccupantsGraphOutputDto;
use App\Application\Dto\Output\Logement\GetTableauBordLogementOutputDto;
use App\Application\Dto\Output\Logement\SetOccupants4ChgtOutputDto;
use App\Application\Dto\Output\Logement\SetSeuilConsoOutputDto;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Factory\Logement\LogementEntityFactory;
use App\Application\Factory\Logement\LogementOutputFactory;

final class LogementTransformer implements LogementTransformerInterface
{
   public function __construct(
      private readonly LogementEntityFactory $entityFactory,
      private readonly LogementOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to GetTableauBordLogementOutputDto
    */
   public function transformGetTableauBordLogement(object $dataSourceResult): GetTableauBordLogementOutputDto
   {
      $result = $dataSourceResult->GetTableauBordLogementResult;
      return new GetTableauBordLogementOutputDto($result);
   }

   /**
    * Transform raw response to SetOccupants4ChgtOutputDto
    */
   public function transformSetOccupants4Chgt(object $dataSourceResult): SetOccupants4ChgtOutputDto
   {
      $occupants = [];
      if (is_array($dataSourceResult->setOccupants4ChgtResult)) {
         foreach ($dataSourceResult->setOccupants4ChgtResult as $occupant) {
            $occupants[] = $occupant;
         }
      }
      return new SetOccupants4ChgtOutputDto($occupants);
   }

   /**
    * Transform raw response to GetOccupants4ChgtOutputDto
    */
   public function transformGetOccupants4Chgt(object $dataSourceResult): GetOccupants4ChgtOutputDto
   {
      $occupants = [];
      if (is_array($dataSourceResult->getOccupants4ChgtResult)) {
         foreach ($dataSourceResult->getOccupants4ChgtResult as $occupant) {
            $occupants[] = $occupant;
         }
      }
      return new GetOccupants4ChgtOutputDto($occupants);
   }

   /**
    * Transform raw response to SetSeuilConsoOutputDto
    */
   public function transformSetSeuilConso(object $dataSourceResult): SetSeuilConsoOutputDto
   {
      $retour = $dataSourceResult->SetSeuilConsoResult;
      return new SetSeuilConsoOutputDto($retour);
   }

   /**
    * Transform raw response to GetStatOccupantsGraphOutputDto
    */
   public function transformGetStatOccupantsGraph(object $dataSourceResult): GetStatOccupantsGraphOutputDto
   {
      $graphPoints = [];
      if (is_array($dataSourceResult->GetStatOccupantsGraphResult)) {
         foreach ($dataSourceResult->GetStatOccupantsGraphResult as $point) {
            $graphPoints[] = $point;
         }
      }
      return new GetStatOccupantsGraphOutputDto($graphPoints);
   }

   /**
    * Transform raw response to GetInfosAppareilsByLogementOutputDto
    */
   public function transformGetInfosAppareilsByLogement(object $dataSourceResult): object
   {
      return $dataSourceResult->GetInfosAppareilsByLogementResult;
   }

   /**
    * Transform raw response to GetInfosLogementsOutputDto
    */
   public function transformGetInfosLogements(object $dataSourceResult): GetInfosLogementsOutputDto
   {
      $result = $dataSourceResult->GetInfosLogementsResult;
      return new GetInfosLogementsOutputDto($result);
   }
}
