<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LoginFromParamOutputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;

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
      return new LoginFromParamOutputDto();
   }

   /**
    * Transform raw response to ResetOrCreateOutputDto
    */
   public function transformResetOrCreate(object $dataSourceResult): ResetOrCreateOutputDto
   {
      return new ResetOrCreateOutputDto();
   }

   /**
    * Transform raw response to ResetPasswordOutputDto
    */
   public function transformResetPassword(object $dataSourceResult): ResetPasswordOutputDto
   {
      return new ResetPasswordOutputDto();
   }

   /**
    * Transform raw response to UpdatePasswordOutputDto
    */
   public function transformUpdatePassword(object $dataSourceResult): UpdatePasswordOutputDto
   {
      return new UpdatePasswordOutputDto();
   }

   /**
    * Transform raw response to LoginOutputDto
    */
   public function transformLogin(object $dataSourceResult): LoginOutputDto
   {
      return new LoginOutputDto();
   }

   /**
    * Transform raw response to LoginOutputDto
    */
   public function transformLogout(object $dataSourceResult): LogoutOutputDto
   {
      return new LogoutOutputDto(true);
   }
}
