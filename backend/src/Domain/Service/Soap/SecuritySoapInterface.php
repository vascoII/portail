<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Input\Security\LogoutInputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Input\Security\LoginInputDto;

interface SecuritySoapInterface
{

  public function createService(CreateInputDto $inputDto): CreateOutputDto;
  public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginOutputDto;
  public function logoutService(LogoutInputDto $inputDto): LogoutOutputDto;
  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetOrCreateOutputDto;
  public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto;
  public function resetPasswordService(ResetPasswordInputDto $inputDto): ResetPasswordOutputDto;
  public function loginService(LoginInputDto $inputDto): LoginOutputDto;
}
