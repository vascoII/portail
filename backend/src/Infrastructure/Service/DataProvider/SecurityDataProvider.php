<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Transformer\SecurityTransformerInterface;

final class SecurityDataProvider implements SecurityDataProviderInterface
{
  public function __construct(
      private SecurityDataSourceInterface $securityDataSource,
      private SecurityTransformerInterface $securityTransformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginOutputDto
  {
      $rawData = $this->securityDataSource->fetchLoginFromParam($inputDto);
      return $this->securityTransformer->transformLoginFromParam($rawData);
  }
  
  public function logoutService(): LogoutOutputDto
  {
      $rawData = $this->securityDataSource->fetchLogout();
      return $this->securityTransformer->transformLogout($rawData);
  }
  
  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetPasswordFromPKUserOutputDto
  {
      $rawData = $this->securityDataSource->fetchResetOrCreate($inputDto);
      return $this->securityTransformer->transformResetOrCreateResponse($rawData);
  }
  
  public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
  {
      $rawData = $this->securityDataSource->fetchUpdatePassword($inputDto);
      return $this->securityTransformer->transformUpdatePassword($rawData);
  }
  
  public function resetPasswordService(ResetPasswordInputDto $inputDto): bool
  {
      $rawData = $this->securityDataSource->fetchResetPassword($inputDto);
      return $this->securityTransformer->transformResetPassword($rawData);
  }
  
  public function loginService(LoginInputDto $inputDto): LoginOutputDto
  {
      $rawData = $this->securityDataSource->fetchLogin($inputDto);
      return $this->securityTransformer->transformLogin($rawData);
  }
  
}
