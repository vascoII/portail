<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Security\PatchEmailInputDto;

interface SecurityDataProviderInterface
{

  public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginOutputDto;
  public function logoutService(): LogoutOutputDto;
  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetPasswordFromPKUserOutputDto;
  public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto;
  public function resetPasswordService(ResetPasswordInputDto $inputDto): ResetPasswordOutputDto;
  public function loginService(LoginInputDto $inputDto): LoginOutputDto;
  public function patchCguService(): SuccessOutputDto;
  public function patchEmailService(PatchEmailInputDto $inputDto): SuccessOutputDto;
}
