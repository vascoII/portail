<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;

interface SecurityDataSourceInterface
{

  public function fetchLogin(LoginInputDto $inputDto): object;
  public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object;
  public function fetchLogout(): object;
  public function fetchResetPassword(ResetPasswordInputDto $inputDto): object;
  public function fetchResetPasswordFromPKUser(ResetPasswordFromPKUserInputDto $inputDto): object;
  public function fetchUpdatePassword(UpdatePasswordInputDto $inputDto): object;
  public function fetchPatchCgu(): object;
}
