<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;

interface SecurityDataSourceInterface
{

  public function fetchLogin(LoginInputDto $inputDto): object;
  public function fetchLogout(): object;
  public function fetchResetPasswordFromPKUser(ResetPasswordFromPKUserInputDto $inputDto): object;
  public function fetchUpdatePassword(UpdatePasswordInputDto $inputDto): object;

}
