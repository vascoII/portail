<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

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
use App\Domain\Service\Soap\SecuritySoapInterface;

final class SecuritySoap implements SecuritySoapInterface
{
  public function createService(CreateInputDto $inputDto): CreateOutputDto
  {
    // TODO: Implement createService logic
    return new CreateOutputDto(true);
  }

  public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginOutputDto
  {
    // TODO: Implement loginFromParamService logic
    return new LoginOutputDto([]);
  }

  public function logoutService(LogoutInputDto $inputDto): LogoutOutputDto
  {
    // TODO: Implement logoutService logic
    return new LogoutOutputDto(true);
  }

  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetOrCreateOutputDto
  {
    // TODO: Implement resetOrCreateService logic
    return new ResetOrCreateOutputDto(true);
  }

  public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
  {
    // TODO: Implement updatePasswordService logic
    return new UpdatePasswordOutputDto(true);
  }

  public function resetPasswordService(ResetPasswordInputDto $inputDto): ResetPasswordOutputDto
  {
    // TODO: Implement resetPasswordService logic
    return new ResetPasswordOutputDto(true);
  }

  public function loginService(LoginInputDto $inputDto): LoginOutputDto
  {
    // TODO: Implement loginService logic
    return new LoginOutputDto([]);
  }
}
