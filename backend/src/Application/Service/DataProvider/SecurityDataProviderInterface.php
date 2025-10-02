<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;

interface SecurityDataProviderInterface
{

  public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginOutputDto;
  public function logoutService(): LogoutOutputDto;
  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetPasswordFromPKUserOutputDto;
  public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto;
  public function resetPasswordService(ResetPasswordInputDto $inputDto): bool;
  public function loginService(LoginInputDto $inputDto): LoginOutputDto;
}
