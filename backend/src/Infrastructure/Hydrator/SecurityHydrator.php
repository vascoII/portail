<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;

final class SecurityHydrator
{
  public function hydrateCreate(CreateInputDto $inputDto): object
  {
    $user = $this->authService->getCurrentUser();
    $sessionId = $this->authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return (object) [
      'SessionID' => $sessionId,
      'PkUser' => $user->pkUser,
      // TODO: Add specific parameters based on CreateInputDto properties
    ];
  }

  public function hydrateLoginFromParam(LoginFromParamInputDto $inputDto): object
  {
    $user = $this->authService->getCurrentUser();
    $sessionId = $this->authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return (object) [
      'SessionID' => $sessionId,
      'PkUser' => $user->pkUser,
      // TODO: Add specific parameters based on LoginFromParamInputDto properties
    ];
  }

  public function hydrateLogout(): object
  {
    $user = $this->authService->getCurrentUser();
    $sessionId = $this->authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return (object) [
      'SessionID' => $sessionId,
      'PkUser' => $user->pkUser,
      // TODO: Add specific parameters based on LogoutInputDto properties
    ];
  }

  public function hydrateResetOrCreate(ResetOrCreateInputDto $inputDto): object
  {
    $user = $this->authService->getCurrentUser();
    $sessionId = $this->authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return (object) [
      'SessionID' => $sessionId,
      'PkUser' => $user->pkUser,
      // TODO: Add specific parameters based on ResetOrCreateInputDto properties
    ];
  }

  public function hydrateUpdatePassword(UpdatePasswordInputDto $inputDto): object
  {
    $user = $this->authService->getCurrentUser();
    $sessionId = $this->authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return (object) [
      'SessionID' => $sessionId,
      'PkUser' => $user->pkUser,
      // TODO: Add specific parameters based on UpdatePasswordInputDto properties
    ];
  }

  public function hydrateResetPassword(ResetPasswordInputDto $inputDto): object
  {
    $user = $this->authService->getCurrentUser();
    $sessionId = $this->authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return (object) [
      'SessionID' => $sessionId,
      'PkUser' => $user->pkUser,
      // TODO: Add specific parameters based on ResetPasswordInputDto properties
    ];
  }

  public function hydrateLogin(LoginInputDto $inputDto): object
  {
    // Login doesn't need authentication context - it's the method that creates it
    return (object) [
      // TODO: Add specific parameters based on LoginInputDto properties
    ];
  }
}
