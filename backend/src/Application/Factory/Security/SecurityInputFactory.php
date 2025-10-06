<?php

declare(strict_types=1);

namespace App\Application\Factory\Security;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\LogoutInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;

final class SecurityInputFactory
{
  public function createCreateFromRequest(Request $request): CreateInputDto
  {
    return new CreateInputDto();
  }

  public function createLoginFromRequest(Request $request): LoginInputDto
  {
    $data = json_decode($request->getContent(), true);
    
    return new LoginInputDto(
      (string) $data['username'] ?? null,
      (string) $data['password'] ?? null
    );
  }

  public function createLoginFromParamFromRequest(Request $request): LoginFromParamInputDto
  {
    $data = json_decode($request->getContent(), true);

    return new LoginFromParamInputDto(
      (string) $data['username'] ?? null,
      (string) $data['password'] ?? null,
      $request->query->get('param')
    );
  }

  public function createLogoutFromRequest(Request $request): LogoutInputDto
  {
    return new LogoutInputDto();
  }

  public function createResetOrCreateFromRequest(Request $request): ResetOrCreateInputDto
  {
    return new ResetOrCreateInputDto();
  }

  public function createResetPasswordFromPKUserFromRequest(Request $request): ResetPasswordFromPKUserInputDto
  {
    return new ResetPasswordFromPKUserInputDto((int) $request->query->get('pkUser'));
  }

  public function createResetPasswordFromRequest(Request $request): ResetPasswordInputDto
  {
    return new ResetPasswordInputDto($request->query->get('email'));
  }

  public function createUpdatePasswordFromRequest(Request $request): UpdatePasswordInputDto
  {
    return new UpdatePasswordInputDto(
      (string) $request->request->get('pkUser'),
      (string) $request->request->get('password')
    );
  }
}
