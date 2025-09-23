<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Operator\AddBuildingOutputDto;
use App\Application\Dto\Output\Operator\CreateOutputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Application\Dto\Output\Operator\EditOutputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;

final class OperatorTransformer
{
   /**
   * Transform raw SOAP response to AddBuildingOutputDto
   */
   public function transformAddBuildingResponse(array $response): AddBuildingOutputDto
   {
      return new AddBuildingOutputDto();
   }

   /**
   * Transform raw SOAP response to CreateOutputDto
   */
   public function transformCreateResponse(array $response): CreateOutputDto
   {
      return new CreateOutputDto();
   }

   /**
   * Transform raw SOAP response to DeleteOutputDto
   */
   public function transformDeleteResponse(array $response): DeleteOutputDto
   {
      return new DeleteOutputDto();
   }

   /**
   * Transform raw SOAP response to EditOutputDto
   */
   public function transformEditResponse(array $response): EditOutputDto
   {
      return new EditOutputDto();
   }

   /**
   * Transform raw SOAP response to EditPasswordOutputDtoputDto
   */
   public function transformEditPasswordResponse(array $response): EditPasswordOutputDto
   {
      return new EditPasswordOutputDto();
   }

   /**
   * Transform raw SOAP response to IndexOutputDto
   */
   public function transformIndexResponse(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw SOAP response to OtatsoccupantsOutputDto
   */
   public function transformOtatsoccupantsResponse(array $response): OtatsoccupantsOutputDto
   {
      return new OtatsoccupantsOutputDto();
   }

   /**
   * Transform raw SOAP response to RemoveBuildingOutputDto
   */
   public function transformRemoveBuildingResponse(array $response): RemoveBuildingOutputDto
   {
      return new RemoveBuildingOutputDto();
   }

   /**
   * Transform raw SOAP response to ViewOutputDto
   */
   public function transformViewResponse(array $response): ViewOutputDto
   {
      return new ViewOutputDto();
   }

}