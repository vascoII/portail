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
    * Transform raw response to AddBuildingOutputDto
    */
   public function transformAddBuilding(object $response): AddBuildingOutputDto
   {
      return new AddBuildingOutputDto();
   }

   /**
    * Transform raw response to CreateOutputDto
    */
   public function transformCreate(object $response): CreateOutputDto
   {
      return new CreateOutputDto();
   }

   /**
    * Transform raw response to DeleteOutputDto
    */
   public function transformDelete(object $response): DeleteOutputDto
   {
      return new DeleteOutputDto();
   }

   /**
    * Transform raw response to EditOutputDto
    */
   public function transformEdit(object $response): EditOutputDto
   {
      return new EditOutputDto();
   }

   /**
    * Transform raw response to EditPasswordOutputDtoputDto
    */
   public function transformEditPassword(object $response): EditPasswordOutputDto
   {
      return new EditPasswordOutputDto();
   }

   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
    * Transform raw response to OtatsoccupantsOutputDto
    */
   public function transformOtatsoccupants(object $response): OtatsoccupantsOutputDto
   {
      return new OtatsoccupantsOutputDto();
   }

   /**
    * Transform raw response to RemoveBuildingOutputDto
    */
   public function transformRemoveBuilding(object $response): RemoveBuildingOutputDto
   {
      return new RemoveBuildingOutputDto();
   }

   /**
    * Transform raw response to ViewOutputDto
    */
   public function transformView(object $response): ViewOutputDto
   {
      return new ViewOutputDto();
   }
}
