<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

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
use App\Application\Dto\Output\Occupant\GetOccupantAccountOutputDto;
use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;
use App\Application\Service\Transformer\OccupantTransformerInterface;
use App\Application\Factory\Occupant\OccupantEntityFactory;
use App\Application\Factory\Occupant\OccupantOutputFactory;

final class OccupantTransformer implements OccupantTransformerInterface
{
   const UPDATED = 'updated';

   public function __construct(
      private readonly OccupantEntityFactory $entityFactory,
      private readonly OccupantOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to AlertesOutputDto
    */
   public function transformAlertes(object $dataSourceResult): AlertesOutputDto
   {
      return new AlertesOutputDto();
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
    * Transform raw response to MyAccountOutputDto
    */
   public function transformMyAccount(object $dataSourceResult): MyAccountOutputDto
   {
      return new MyAccountOutputDto();
   }

   /**
    * Transform raw response to ShowEauReleveOutputDto
    */
   public function transformShowEauReleve(object $dataSourceResult): ShowEauReleveOutputDto
   {
      return new ShowEauReleveOutputDto();
   }

   /**
    * Transform raw response to ShowInterventionOutputDto
    */
   public function transformShowIntervention(object $dataSourceResult): ShowInterventionOutputDto
   {
      return new ShowInterventionOutputDto();
   }

   /**
    * Transform raw response to ShowNoteReleveOutputDto
    */
   public function transformShowNoteReleve(object $dataSourceResult): ShowNoteReleveOutputDto
   {
      return new ShowNoteReleveOutputDto();
   }

   /**
    * Transform raw response to ShowOutputDto
    */
   public function transformShow(object $dataSourceResult): ShowOutputDto
   {
      return new ShowOutputDto();
   }

   /**
    * Transform raw response to ShowRepartReleveOutputDto
    */
   public function transformShowRepartReleve(object $dataSourceResult): ShowRepartReleveOutputDto
   {
      return new ShowRepartReleveOutputDto();
   }

   /**
    * Transform raw response to SimulateurOutputDto
    */
   public function transformSimulateur(object $dataSourceResult): SimulateurOutputDto
   {
      return new SimulateurOutputDto();
   }

   /**
    * Transform raw response to EditOutputDto
    */
   public function transformEdit(object $dataSourceResult): EditOutputDto
   {
      return new EditOutputDto($dataSourceResult[self::UPDATED]);
   }

   /**
    * Transform raw response to GetOccupantAccountOutputDto
    */
   public function transformGetOccupantAccount(object $dataSourceResult): GetOccupantAccountOutputDto
   {
      return new GetOccupantAccountOutputDto($dataSourceResult);
   }

   /**
    * Transform raw response to GetOccupantOutputDto
    */
   public function transformGetOccupant(object $dataSourceResult): GetOccupantOutputDto
   {
      return new GetOccupantOutputDto($dataSourceResult);
   }
}
