<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;
use App\Application\Dto\Output\Admin\LoginFromParamOutputDto;
use App\Application\Dto\Output\Admin\ResetPasswordFromEmailOutputDto;
use App\Application\Dto\Output\Admin\UpdateCGUFromPKUserOutputDto;
use App\Application\Dto\Output\Admin\UpdateEmailFromPKUserOutputDto;

interface AdminTransformerInterface
{
  /**
   * Transform raw response to LoginFromParamOutputDto
   */
  public function transformLoginFromParam(object $dataSourceResult): LoginFromParamOutputDto;
  

  /**
   * Transform raw response to GetSousTraitantsOutputDto
   */
  public function transformGetSousTraitants(object $dataSourceResult): GetSousTraitantsOutputDto;
  

  /**
   * Transform raw response to UpdateEmailFromPKUserOutputDto
   */
  public function transformUpdateEmailFromPKUser(object $dataSourceResult): UpdateEmailFromPKUserOutputDto;
  
  /**
   * Transform raw response to UpdateCGUFromPKUserOutputDto
   */
  public function transformUpdateCGUFromPKUser(object $dataSourceResult): UpdateCGUFromPKUserOutputDto;
 
  /**
   * Transform raw response to ResetPasswordFromEmailOutputDto
   */
  public function transformResetPasswordFromEmail(object $dataSourceResult): ResetPasswordFromEmailOutputDto;
  
}
