<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Operator\CreateGestionnaireOutputDto;
use App\Application\Dto\Output\Operator\DeleteUserOutputDto;
use App\Application\Dto\Output\Operator\GetChildUsersOutputDto;
use App\Application\Dto\Output\Operator\GetUserOutputDto;
use App\Application\Dto\Output\Operator\SetImmeublesOutputDto;
use App\Application\Dto\Output\Operator\UpdateUserOutputDto;

final class OperatorTransformer
{
   /**
    * Transform raw response to SetImmeublesOutputDto
    */
   public function transformSetImmeubles(object $dataSourceResult): SetImmeublesOutputDto
   {
      $retour = $dataSourceResult->SetImmeublesResult;
      return new SetImmeublesOutputDto($retour);
   }

   /**
    * Transform raw response to CreateGestionnaireOutputDto
    */
   public function transformCreateGestionnaire(object $dataSourceResult): CreateGestionnaireOutputDto
   {
      $success = $dataSourceResult->CreateGestionnaireResult;
      return new CreateGestionnaireOutputDto($success);
   }

   /**
    * Transform raw response to DeleteUserOutputDto
    */
   public function transformDeleteUser(object $dataSourceResult): DeleteUserOutputDto
   {
      $retour = $dataSourceResult->DeleteUserResult;
      return new DeleteUserOutputDto($retour);
   }

   /**
    * Transform raw response to GetChildUsersOutputDto
    */
   public function transformGetChildUsers(object $dataSourceResult): GetChildUsersOutputDto
   {
      $users = $dataSourceResult->GetChildUsersResult;
      return new GetChildUsersOutputDto($users);
   }

   /**
    * Transform raw response to GetUserOutputDto
    */
   public function transformGetUser(object $dataSourceResult): GetUserOutputDto
   {
      $user = $dataSourceResult->GetUserResult;
      return new GetUserOutputDto($user);
   }

   /**
    * Transform raw response to UpdateUserOutputDto
    */
   public function transformUpdateUser(object $dataSourceResult): UpdateUserOutputDto
   {
      $retour = $dataSourceResult->UpdateUser3Result;
      return new UpdateUserOutputDto($retour);
   }
}
