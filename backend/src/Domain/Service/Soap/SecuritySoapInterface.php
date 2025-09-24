<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;

use App\Application\Dto\Output\Security\LoginOutputDto;

interface SecuritySoapInterface
{

  public function createService(CreateInputDto $inputDto): array;
  public function loginFromParamService(LoginFromParamInputDto $inputDto): array;
  public function logoutService(): array;
  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): array;
  public function updatePasswordService(UpdatePasswordInputDto $inputDto): array;
  public function resetPasswordService(ResetPasswordInputDto $inputDto): array;
  public function loginService(LoginInputDto $inputDto): LoginOutputDto;
}
