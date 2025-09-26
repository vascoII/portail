<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;

final class SecurityTransformer
{
   /**
   * Transform raw SOAP response to CreateOutputDto
   */
   public function transformCreateResponse(array $response): CreateOutputDto
   {
      return new CreateOutputDto(true);
   }

   /**
   * Transform raw SOAP response to LoginFromParamOutputDto
   */
   public function transformLoginFromParamResponse(array $response): LoginOutputDto
   {
      return new LoginOutputDto();
   }

   /**
   * Transform raw SOAP response to ResetOrCreateOutputDto
   */
   public function transformResetOrCreateResponse(array $response): ResetOrCreateOutputDto
   {
      return new ResetOrCreateOutputDto();
   }

   /**
   * Transform raw SOAP response to ResetPasswordOutputDto
   */
   public function transformResetPasswordResponse(array $response): ResetPasswordOutputDto
   {
      return new ResetPasswordOutputDto();
   }

   /**
   * Transform raw SOAP response to UpdatePasswordOutputDto
   */
   public function transformUpdatePasswordResponse(array $response): UpdatePasswordOutputDto
   {
      return new UpdatePasswordOutputDto();
   }

   /**
   * Transform raw SOAP response to LoginOutputDto
   */
   public function transformLoginResponse(array $response): LoginOutputDto
   {
      return new LoginOutputDto();
   }

   /**
   * Transform raw SOAP response to LoginOutputDto
   */
   public function transformLogoutResponse(array $response): LogoutOutputDto
   {
      return new LogoutOutputDto(true);
   }

}