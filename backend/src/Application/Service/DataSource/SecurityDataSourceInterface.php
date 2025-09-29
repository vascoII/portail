<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;

interface SecurityDataSourceInterface
{

  public function fetchCreate(CreateInputDto $inputDto): object;
  public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object;
  public function fetchLogout(): object;
  public function fetchResetOrCreate(ResetOrCreateInputDto $inputDto): object;
  public function fetchUpdatePassword(UpdatePasswordInputDto $inputDto): object;
  public function fetchResetPassword(ResetPasswordInputDto $inputDto): object;
  public function fetchLogin(LoginInputDto $inputDto): object;
}
