<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Application\Dto\Output\Occupant\ListAnomaliesOutputDto;
use App\Application\Dto\Output\Occupant\ListDysfunctionsOutputDto;
use App\Application\Dto\Output\Occupant\ListInterventionsOutputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Application\Dto\Output\Occupant\EditOutputDto;

interface OccupantTransformerInterface
{
   /**
    * Transform raw response to AlertesOutputDto
    */
   public function transformAlertes(object $dataSourceResult): AlertesOutputDto;
   

   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOutputDto;
   

   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $dataSourceResult): ListDysfunctionsOutputDto;
   

   /**
    * Transform raw response to ListInterventionsOutputDto
    */
   public function transformListInterventions(object $dataSourceResult): ListInterventionsOutputDto;
   

   /**
    * Transform raw response to ListLeaksOutputDto
    */
   public function transformListLeaks(object $dataSourceResult): ListLeaksOutputDto;
  

   /**
    * Transform raw response to MyAccountOutputDto
    */
   public function transformMyAccount(object $dataSourceResult): MyAccountOutputDto;
   

   /**
    * Transform raw response to ShowEauReleveOutputDto
    */
   public function transformShowEauReleve(object $dataSourceResult): ShowEauReleveOutputDto;
   

   /**
    * Transform raw response to ShowInterventionOutputDto
    */
   public function transformShowIntervention(object $dataSourceResult): ShowInterventionOutputDto;
  

   /**
    * Transform raw response to ShowNoteReleveOutputDto
    */
   public function transformShowNoteReleve(object $dataSourceResult): ShowNoteReleveOutputDto;
   

   /**
    * Transform raw response to ShowOutputDto
    */
   public function transformShow(object $dataSourceResult): ShowOutputDto;
  

   /**
    * Transform raw response to ShowRepartReleveOutputDto
    */
   public function transformShowRepartReleve(object $dataSourceResult): ShowRepartReleveOutputDto;
   

   /**
    * Transform raw response to SimulateurOutputDto
    */
   public function transformSimulateur(object $dataSourceResult): SimulateurOutputDto;
   

   /**
    * Transform raw response to EditOutputDto
    */
   public function transformEdit(object $dataSourceResult): EditOutputDto;
   
}
