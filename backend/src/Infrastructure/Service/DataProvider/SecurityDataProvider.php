<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Output\Security\LoginFromParamOutputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Infrastructure\Transformer\SecurityTransformer;

final class SecurityDataProvider implements SecurityDataProviderInterface
{
  public function __construct(
      private SecurityDataSourceInterface $source,
      private SecurityTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function createService(CreateInputDto $inputDto): CreateOutputDto
  {
      $rawData = $this->source->fetchCreate($inputDto);
      return $this->transformer->transformCreateResponse($rawData);
  }

  public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginFromParamOutputDto
  {
      $rawData = $this->source->fetchLoginFromParam($inputDto);
      return $this->transformer->transformLoginFromParamResponse($rawData);
  }
  
  public function logoutService(): LogoutOutputDto
  {
      $rawData = $this->source->fetchLogout($inputDto);
      return $this->transformer->transformLogoutResponse($rawData);

  }
  
  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetOrCreateOutputDto
  {
      $rawData = $this->source->fetchResetOrCreate($inputDto);
      return $this->transformer->transformResetOrCreateResponse($rawData);

  }
  
  public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
  {
      $rawData = $this->source->fetchUpdatePassword($inputDto);
      return $this->transformer->transformUpdatePasswordResponse($rawData);

  }
  
  public function resetPasswordService(ResetPasswordInputDto $inputDto): ResetPasswordOutputDto
  {
      $rawData = $this->source->fetchResetPassword($inputDto);
      return $this->transformer->transformResetPasswordResponse($rawData);

  }
  
  public function loginService(LoginInputDto $inputDto): LoginOutputDto
  {
      $rawData = $this->source->fetchLogin($inputDto);
      return $this->transformer->transformLoginResponse($rawData);

  }
  
}
