<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LoginFromParamOutputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;

interface SecurityTransformerInterface
{
   /**
    * Transform raw response to CreateOutputDto
    */
   public function transformCreate(object $dataSourceResult): CreateOutputDto;
   

   /**
    * Transform raw response to LoginFromParamOutputDto
    */
   public function transformLoginFromParam(object $dataSourceResult): LoginFromParamOutputDto;
   

   /**
    * Transform raw response to ResetOrCreateOutputDto
    */
   public function transformResetOrCreate(object $dataSourceResult): ResetOrCreateOutputDto;
   

   /**
    * Transform raw response to ResetPasswordOutputDto
    */
   public function transformResetPassword(object $dataSourceResult): ResetPasswordOutputDto;
   

   /**
    * Transform raw response to UpdatePasswordOutputDto
    */
   public function transformUpdatePassword(object $dataSourceResult): UpdatePasswordOutputDto;
   

   /**
    * Transform raw response to LoginOutputDto
    */
   public function transformLogin(object $dataSourceResult): LoginOutputDto;
   

   /**
    * Transform raw response to ResetPasswordFromPKUserOutputDto
    */
   public function transformResetPasswordFromPKUser(object $dataSourceResult): ResetPasswordFromPKUserOutputDto;
   

   /**
    * Transform raw response to LogoutOutputDto
    */
   public function transformLogout(object $dataSourceResult): LogoutOutputDto;
  
}
