<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;

final class SecurityHydrator
{
  public function hydrateLogin(LoginInputDto $inputDto): object
  {
    // Login doesn't need authentication context - it's the method that creates it
    return (object) [
      'LoginID' => $inputDto->username,
      'Password' => $inputDto->password,
    ];
  }

  public function hydrateResetPasswordFromPKUser(ResetPasswordFromPKUserInputDto $inputDto): object
  {
    // Login doesn't need authentication context - it's the method that creates it
    return (object) [
      'PKUser' => $inputDto->pkUser,
    ];
  }

  public function hydrateUpdatePassword(UpdatePasswordInputDto $inputDto): object
  {
    // Login doesn't need authentication context - it's the method that creates it
    return (object) [
      'PkUserChild' => $inputDto->pkUser,
      'Password' => $inputDto->password
    ];
  }

  public function hydrateLoginFromParam(LoginFromParamInputDto $inputDto): object
  {
    return (object) [
      'LoginID' => $inputDto->username,
      'Password' => $inputDto->password,
      'Param' => $inputDto->param,
    ];
  }

  public function hydrateResetPassword(ResetPasswordInputDto $inputDto): object
  {
    return (object) [
      'Email' => $inputDto->email,
    ];
  }
}
