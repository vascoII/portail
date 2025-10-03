<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Operator\CreateGestionnaireOutputDto;
use App\Application\Dto\Output\Operator\DeleteUserOutputDto;
use App\Application\Dto\Output\Operator\GetChildUsersOutputDto;
use App\Application\Dto\Output\Operator\GetUserOutputDto;
use App\Application\Dto\Output\Operator\SetImmeublesOutputDto;
use App\Application\Dto\Output\Operator\UpdateUserOutputDto;

interface OperatorTransformerInterface
{
   /**
    * Transform raw response to SetImmeublesOutputDto
    */
   public function transformSetImmeubles(object $dataSourceResult): SetImmeublesOutputDto;
   

   /**
    * Transform raw response to CreateGestionnaireOutputDto
    */
   public function transformCreateGestionnaire(object $dataSourceResult): CreateGestionnaireOutputDto;
   

   /**
    * Transform raw response to DeleteUserOutputDto
    */
   public function transformDeleteUser(object $dataSourceResult): DeleteUserOutputDto;
   

   /**
    * Transform raw response to GetChildUsersOutputDto
    */
   public function transformGetChildUsers(object $dataSourceResult): GetChildUsersOutputDto;
   

   /**
    * Transform raw response to GetUserOutputDto
    */
   public function transformGetUser(object $dataSourceResult): GetUserOutputDto;
   

   /**
    * Transform raw response to UpdateUserOutputDto
    */
   public function transformUpdateUser(object $dataSourceResult): UpdateUserOutputDto;
   
}
