<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;
use App\Application\Dto\Output\Occupant\ExportDysfunctionsOutputDto;
use App\Application\Dto\Output\Occupant\ExportInterventionsOutputDto;
use App\Application\Dto\Output\Occupant\ExportLeaksOutputDto;
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

final class OccupantTransformer
{
   const UPDATED = 'updated';
   /**
    * Transform raw response to AlertesOutputDto
    */
   public function transformAlertes(object $response): AlertesOutputDto
   {
      return new AlertesOutputDto();
   }

   /**
    * Transform raw response to ExportAnomaliesOutputDto
    */
   public function transformExportAnomalies(object $response): ExportAnomaliesOutputDto
   {
      return new ExportAnomaliesOutputDto();
   }

   /**
    * Transform raw response to ExportDysfunctionsOutputDto
    */
   public function transformExportDysfunctions(object $response): ExportDysfunctionsOutputDto
   {
      return new ExportDysfunctionsOutputDto();
   }

   /**
    * Transform raw response to ExportInterventionsOutputDto
    */
   public function transformExportInterventions(object $response): ExportInterventionsOutputDto
   {
      return new ExportInterventionsOutputDto();
   }

   /**
    * Transform raw response to ExportLeaksOutputDto
    */
   public function transformExportLeaks(object $response): ExportLeaksOutputDto
   {
      return new ExportLeaksOutputDto();
   }

   /**
    * Transform raw response to ListAnomaliesOutputDto
    */
   public function transformListAnomalies(object $response): ListAnomaliesOutputDto
   {
      return new ListAnomaliesOutputDto();
   }

   /**
    * Transform raw response to ListDysfunctionsOutputDto
    */
   public function transformListDysfunctions(object $response): ListDysfunctionsOutputDto
   {
      return new ListDysfunctionsOutputDto();
   }

   /**
    * Transform raw response to ListInterventionsOutputDto
    */
   public function transformListInterventions(object $response): ListInterventionsOutputDto
   {
      return new ListInterventionsOutputDto();
   }

   /**
    * Transform raw response to ListLeaksOutputDto
    */
   public function transformListLeaks(object $response): ListLeaksOutputDto
   {
      return new ListLeaksOutputDto();
   }

   /**
    * Transform raw response to MyAccountOutputDto
    */
   public function transformMyAccount(object $response): MyAccountOutputDto
   {
      return new MyAccountOutputDto();
   }

   /**
    * Transform raw response to ShowEauReleveOutputDto
    */
   public function transformShowEauReleve(object $response): ShowEauReleveOutputDto
   {
      return new ShowEauReleveOutputDto();
   }

   /**
    * Transform raw response to ShowInterventionOutputDto
    */
   public function transformShowIntervention(object $response): ShowInterventionOutputDto
   {
      return new ShowInterventionOutputDto();
   }

   /**
    * Transform raw response to ShowNoteReleveOutputDto
    */
   public function transformShowNoteReleve(object $response): ShowNoteReleveOutputDto
   {
      return new ShowNoteReleveOutputDto();
   }

   /**
    * Transform raw response to ShowOutputDto
    */
   public function transformShow(object $response): ShowOutputDto
   {
      return new ShowOutputDto();
   }

   /**
    * Transform raw response to ShowRepartReleveOutputDto
    */
   public function transformShowRepartReleve(object $response): ShowRepartReleveOutputDto
   {
      return new ShowRepartReleveOutputDto();
   }

   /**
    * Transform raw response to SimulateurOutputDto
    */
   public function transformSimulateur(object $response): SimulateurOutputDto
   {
      return new SimulateurOutputDto();
   }

   /**
    * Transform raw response to EditOutputDto
    */
   public function transformEdit(object $response): EditOutputDto
   {
      return new EditOutputDto($response[self::UPDATED]);
   }
}
