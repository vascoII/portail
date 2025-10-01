<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LoginFromParamOutputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Dto\Output\Security\UserDto;

final class SecurityTransformer
{
   /**
    * Transform raw response to CreateOutputDto
    */
   public function transformCreate(object $dataSourceResult): CreateOutputDto
   {
      return new CreateOutputDto(true);
   }

   /**
    * Transform raw response to LoginFromParamOutputDto
    */
   public function transformLoginFromParam(object $dataSourceResult): LoginFromParamOutputDto
   {
      return new LoginFromParamOutputDto(true);
   }

   /**
    * Transform raw response to ResetOrCreateOutputDto
    */
   public function transformResetOrCreate(object $dataSourceResult): ResetOrCreateOutputDto
   {
      return new ResetOrCreateOutputDto(true);
   }

   /**
    * Transform raw response to ResetPasswordOutputDto
    */
   public function transformResetPassword(object $dataSourceResult): ResetPasswordOutputDto
   {
      return new ResetPasswordOutputDto(true);
   }

   /**
    * Transform raw response to UpdatePasswordOutputDto
    */
   public function transformUpdatePassword(object $dataSourceResult): UpdatePasswordOutputDto
   {
      $updated = (bool) $dataSourceResult->UpdatePasswordResult;
      return new UpdatePasswordOutputDto($updated);
   }

   /**
    * Transform raw response to LoginOutputDto
    */
   public function transformLogin(object $dataSourceResult): LoginOutputDto
   {
      $success = (bool) $dataSourceResult->LoginResult;
      return new LoginOutputDto($success);
   }

   /**
    * Transform raw response to ResetPasswordFromPKUserOutputDto
    */
   public function transformResetPasswordFromPKUser(object $dataSourceResult): ResetPasswordFromPKUserOutputDto
   {
      $user = $this->transformUser($dataSourceResult->ResetPasswordFromPKUserResult);
      return new ResetPasswordFromPKUserOutputDto($user);
   }

   /**
    * Transform raw response to LogoutOutputDto
    */
   public function transformLogout(object $dataSourceResult): LogoutOutputDto
   {
      $loggedOut = (bool) $dataSourceResult->LogoutResult;
      return new LogoutOutputDto($loggedOut);
   }

   /**
    * Transform SOAP user object to UserDto
    */
   private function transformUser(object $soapUser): UserDto
   {
      return new UserDto(
         loginId: (string) $soapUser->LoginID,
         userName: (string) $soapUser->UserName,
         email: (string) $soapUser->EMail,
         userType: (string) $soapUser->UserType,
         pkUser: (int) $soapUser->PKUser,
         address: (string) $soapUser->Adresse,
         postalCode: (string) $soapUser->CP,
         city: (string) $soapUser->Ville,
         fk: (int) $soapUser->FK,
         phoneNumber: (string) $soapUser->PhoneNumber,
         firstName: (string) $soapUser->FirstName,
         userRole: (string) $soapUser->UserRole,
         clientName: (string) $soapUser->ClientName,
         clientId: (string) $soapUser->ClientID,
         expirationDate: (string) $soapUser->ExpirationDate,
         passwordExpirationDate: (string) $soapUser->PasswordExpirationDate,
         cgu: (string) $soapUser->CGU,
         fkClient: (int) $soapUser->FKClient,
         fkClientTop: (int) $soapUser->FKClientTop,
         nbImmeubles: (int) $soapUser->NbImmeubles,
         seuilConsoEf: (int) $soapUser->Seuil_Conso_EF,
         seuilConsoEc: (int) $soapUser->Seuil_Conso_EC,
         seuilConsoRepart: (int) $soapUser->Seuil_Conso_Repart,
         seuilConsoCet: (int) $soapUser->Seuil_Conso_CET,
         seuilConsoActif: (bool) $soapUser->Seuil_Conso_Actif,
         seuilConsoEmail: (string) $soapUser->Seuil_Conso_Email,
         showImmeublesArc: (bool) $soapUser->showImmeublesArc,
         showFactures: (bool) $soapUser->showFactures,
         showChgtOccupant: (bool) $soapUser->showChgtOccupant,
         showChantiers: (bool) $soapUser->showChantiers
      );
   }
}
