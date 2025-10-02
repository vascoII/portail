<?php

declare(strict_types=1);

namespace App\Application\Factory\Admin;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Admin\LoginFromParamInputDto;
use App\Application\Dto\Input\Admin\ResetPasswordFromEmailInputDto;
use App\Application\Dto\Input\Admin\UpdateEmailFromPKUserInputDto;
use App\Application\Dto\Input\Admin\UpdateCGUFromPKUserInputDto;

final class AdminInputFactory
{

  public function createLoginFromParamFromRequest(Request $request): LoginFromParamInputDto
  {
    return new LoginFromParamInputDto($request->query->get('param'));
  }

  public function createResetPasswordFromEmailFromRequest(Request $request)
  {
    return new ResetPasswordFromEmailInputDto($request->query->get('email'));
  }

  public function createUpdateEmailFromPKUserFromRequest(Request $request): UpdateEmailFromPKUserInputDto
  {
    return new UpdateEmailFromPKUserInputDto(
      $request->query->get('pkUser'),
      $request->query->get('email')
    );
  }

  public function createUpdateCGUFromPKUserFromRequest(Request $request): UpdateCGUFromPKUserInputDto
  {
    return new UpdateCGUFromPKUserInputDto(
      $request->query->get('pkUser'),
      $request->query->get('cgu')
    );
  }
}
