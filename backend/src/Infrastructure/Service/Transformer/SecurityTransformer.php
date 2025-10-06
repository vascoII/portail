<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Dto\Output\Security\SessionDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Service\Transformer\SecurityTransformerInterface;
use App\Application\Factory\Security\SecurityEntityFactory;
use App\Application\Factory\Security\SecurityOutputFactory;

final class SecurityTransformer implements SecurityTransformerInterface
{
   public function __construct(
      private readonly SecurityEntityFactory $entityFactory,
      private readonly SecurityOutputFactory $outputFactory
   ) {}

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
   public function transformLoginFromParam(object $dataSourceResult): SessionDto
   {
      return new SessionDto();
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
   public function transformLoginToSession(object $dataSourceResult): SessionDto
   {
      $userRaw = $dataSourceResult->User ?? null; 
      $SessionIdRaw = $dataSourceResult->SessionID ?? null;
      $isConnected =  $dataSourceResult->Connected ?? false;

      $user = $this->entityFactory->createUserFromRaw($userRaw);
      $session = $this->entityFactory->createSessionFromRaw($isConnected, $SessionIdRaw, $user);
     
      return $this->outputFactory->createSessionDto($session);
   }

   public function transformToLoginOutput(SessionDto $sessionDto, string $token): LoginOutputDto
   {
      return $this->outputFactory->createLoginOutputDto($sessionDto, $token);
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

}
