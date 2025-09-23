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

final class OccupantTransformer
{
   /**
   * Transform raw SOAP response to AlertesOutputDto
   */
   public function transformAlertesResponse(array $response): AlertesOutputDto
   {
      return new AlertesOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportAnomaliesOutputDto
   */
   public function transformExportAnomaliesResponse(array $response): ExportAnomaliesOutputDto
   {
      return new ExportAnomaliesOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportDysfunctionsOutputDto
   */
   public function transformExportDysfunctionsResponse(array $response): ExportDysfunctionsOutputDto
   {
      return new ExportDysfunctionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportInterventionsOutputDto
   */
   public function transformExportInterventionsResponse(array $response): ExportInterventionsOutputDto
   {
      return new ExportInterventionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ExportLeaksOutputDto
   */
   public function transformExportLeaksResponse(array $response): ExportLeaksOutputDto
   {
      return new ExportLeaksOutputDto();
   }

   /**
   * Transform raw SOAP response to ListAnomaliesOutputDto
   */
   public function transformListAnomaliesResponse(array $response): ListAnomaliesOutputDto
   {
      return new ListAnomaliesOutputDto();
   }

   /**
   * Transform raw SOAP response to ListDysfunctionsOutputDto
   */
   public function transformListDysfunctionsResponse(array $response): ListDysfunctionsOutputDto
   {
      return new ListDysfunctionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ListInterventionsOutputDto
   */
   public function transformListInterventionsResponse(array $response): ListInterventionsOutputDto
   {
      return new ListInterventionsOutputDto();
   }

   /**
   * Transform raw SOAP response to ListLeaksOutputDto
   */
   public function transformListLeaksResponse(array $response): ListLeaksOutputDto
   {
      return new ListLeaksOutputDto();
   }

   /**
   * Transform raw SOAP response to MyAccountOutputDto
   */
   public function transformMyAccountResponse(array $response): MyAccountOutputDto
   {
      return new MyAccountOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowEauReleveOutputDto
   */
   public function transformShowEauReleveResponse(array $response): ShowEauReleveOutputDto
   {
      return new ShowEauReleveOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowInterventionOutputDto
   */
   public function transformShowInterventionResponse(array $response): ShowInterventionOutputDto
   {
      return new ShowInterventionOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowNoteReleveOutputDto
   */
   public function transformShowNoteReleveResponse(array $response): ShowNoteReleveOutputDto
   {
      return new ShowNoteReleveOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowOutputDto
   */
   public function transformShowResponse(array $response): ShowOutputDto
   {
      return new ShowOutputDto();
   }

   /**
   * Transform raw SOAP response to ShowRepartReleveOutputDto
   */
   public function transformShowRepartReleveResponse(array $response): ShowRepartReleveOutputDto
   {
      return new ShowRepartReleveOutputDto();
   }

   /**
   * Transform raw SOAP response to SimulateurOutputDto
   */
   public function transformSimulateurResponse(array $response): SimulateurOutputDto
   {
      return new SimulateurOutputDto();
   }

}