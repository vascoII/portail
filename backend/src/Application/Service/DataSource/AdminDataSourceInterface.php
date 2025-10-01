<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Admin\LoginFromParamInputDto;
use App\Application\Dto\Input\Admin\ResetPasswordFromEmailInputDto;
use App\Application\Dto\Input\Admin\UpdateEmailFromPKUserInputDto;
use App\Application\Dto\Input\Admin\UpdateCGUFromPKUserInputDto;

interface AdminDataSourceInterface
{

  public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object;
  public function fetchResetPasswordFromEmail(ResetPasswordFromEmailInputDto $inputDto): object;
  public function fetchUpdateEmailFromPKUser(UpdateEmailFromPKUserInputDto $inputDto): object;
  public function fetchUpdateCGUFromPKUser(UpdateCGUFromPKUserInputDto $inputDto): object;
  public function fetchGetSousTraitants(): object;
}
