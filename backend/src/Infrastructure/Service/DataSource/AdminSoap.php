<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\DataSource\AdminDataSourceInterface;
use App\Application\Dto\Input\Admin\LoginFromParamInputDto;
use App\Application\Dto\Input\Admin\ResetPasswordFromEmailInputDto;
use App\Application\Dto\Input\Admin\UpdateEmailFromPKUserInputDto;
use App\Application\Dto\Input\Admin\UpdateCGUFromPKUserInputDto;
use App\Infrastructure\Hydrator\AdminHydrator;
use App\Infrastructure\Service\DataSource\SoapClient;

final class AdminSoap implements AdminDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly AdminHydrator $hydrator
  ) {}

  public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateLoginFromParam($inputDto);
    return $this->soapClient->call('LoginFromParam', $soapRequest);
  }

  public function fetchResetPasswordFromEmail(ResetPasswordFromEmailInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateResetPasswordFromEmail($inputDto);
    return $this->soapClient->call('ResetPasswordFromEmail', $soapRequest);
  }

  public function fetchUpdateEmailFromPKUser(UpdateEmailFromPKUserInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateUpdateEmailFromPKUser($inputDto);
    return $this->soapClient->call('UpdateEmailFromPKUser', $soapRequest);
  }
  
  public function fetchUpdateCGUFromPKUser(UpdateCGUFromPKUserInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateUpdateCGUFromPKUser($inputDto);
    return $this->soapClient->call('UpdateCGUFromPKUser', $soapRequest);
  }

  public function fetchGetSousTraitants(): object
  {
    $soapRequest = $this->hydrator->hydrateGetSousTraitants();
    return $this->soapClient->call('GetSousTraitants', $soapRequest);
  }

}
