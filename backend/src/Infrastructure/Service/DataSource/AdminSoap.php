<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\DataSource\AdminDataSourceInterface;
use App\Application\Dto\Input\Admin\LoginFromParamInputDto;
use App\Application\Dto\Input\Admin\ResetPasswordFromEmailInputDto;
use App\Application\Dto\Input\Admin\UpdateEmailFromPKUserInputDto;
use App\Application\Dto\Input\Admin\UpdateCGUFromPKUserInputDto;
use App\Infrastructure\Service\Hydrator\AdminHydrator;
use App\Infrastructure\Service\DataSource\SoapClient;

final class AdminSoap extends Soap implements AdminDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly AdminHydrator $hydrator
  ) {
    parent::__construct($soapClient);
  }

  public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateLoginFromParam($inputDto);
    return $this->safeCall('LoginFromParam', $soapRequest);
  }

  public function fetchResetPasswordFromEmail(ResetPasswordFromEmailInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateResetPasswordFromEmail($inputDto);
    return $this->safeCall('ResetPasswordFromEmail', $soapRequest);
  }

  public function fetchUpdateEmailFromPKUser(UpdateEmailFromPKUserInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateUpdateEmailFromPKUser($inputDto);
    return $this->safeCall('UpdateEmailFromPKUser', $soapRequest);
  }
  
  public function fetchUpdateCGUFromPKUser(UpdateCGUFromPKUserInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateUpdateCGUFromPKUser($inputDto);
    return $this->safeCall('UpdateCGUFromPKUser', $soapRequest);
  }

  public function fetchGetSousTraitants(): object
  {
    $soapRequest = $this->hydrator->hydrateGetSousTraitants();
    return $this->safeCall('GetSousTraitants', $soapRequest);
  }

}
