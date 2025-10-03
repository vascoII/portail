<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Logement\GetInfosLogementsOutputDto;
use App\Application\Dto\Output\Logement\GetOccupants4ChgtOutputDto;
use App\Application\Dto\Output\Logement\GetStatOccupantsGraphOutputDto;
use App\Application\Dto\Output\Logement\GetTableauBordLogementOutputDto;
use App\Application\Dto\Output\Logement\SetOccupants4ChgtOutputDto;
use App\Application\Dto\Output\Logement\SetSeuilConsoOutputDto;

interface LogementTransformerInterface
{
   /**
    * Transform raw response to GetTableauBordLogementOutputDto
    */
   public function transformGetTableauBordLogement(object $dataSourceResult): GetTableauBordLogementOutputDto;
  
   /**
    * Transform raw response to SetOccupants4ChgtOutputDto
    */
   public function transformSetOccupants4Chgt(object $dataSourceResult): SetOccupants4ChgtOutputDto;
   

   /**
    * Transform raw response to GetOccupants4ChgtOutputDto
    */
   public function transformGetOccupants4Chgt(object $dataSourceResult): GetOccupants4ChgtOutputDto;
   

   /**
    * Transform raw response to SetSeuilConsoOutputDto
    */
   public function transformSetSeuilConso(object $dataSourceResult): SetSeuilConsoOutputDto;
  

   /**
    * Transform raw response to GetStatOccupantsGraphOutputDto
    */
   public function transformGetStatOccupantsGraph(object $dataSourceResult): GetStatOccupantsGraphOutputDto;
   

   /**
    * Transform raw response to GetInfosAppareilsByLogementOutputDto
    */
   public function transformGetInfosAppareilsByLogement(object $dataSourceResult): object;
  
   /**
    * Transform raw response to GetInfosLogementsOutputDto
    */
   public function transformGetInfosLogements(object $dataSourceResult): GetInfosLogementsOutputDto;
   
}
