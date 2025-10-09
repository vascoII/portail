<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Logement\GetTableauBordLogementInputDto;
use App\Application\Dto\Input\Logement\GetNbTicketsInterByLogementInputDto;
use App\Application\Dto\Input\Logement\SetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\GetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\SetSeuilConsoInputDto;
use App\Application\Dto\Input\Logement\GetStatOccupantsGraphInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilsByLogementInpuDto;
use App\Application\Dto\Input\Logement\GetInfosLogementsInputDto;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\LogementHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class LogementSoap extends Soap implements LogementDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly LogementHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {
    parent::__construct($soapClient);
  }

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchGetTableauBordLogement(GetTableauBordLogementInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetTableauBordLogement($inputDto);
    return $this->safeCall('GetTableauBordLogement', $soapRequest);
  }

  public function fetchGetNbTicketsInterByLogement(GetNbTicketsInterByLogementInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetNbTicketsInterByLogement($inputDto);
    return $this->safeCall('GetNbTicketsInterByLogement', $soapRequest);
  }

  public function fetchsetOccupants4Chgt(SetOccupants4ChgtInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateSetOccupants4Chgt($inputDto);
    return $this->safeCall('setOccupants4Chgt', $soapRequest);
  }

  public function fetchgetOccupants4Chgt(GetOccupants4ChgtInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetOccupants4Chgt($inputDto);
    return $this->safeCall('getOccupants4Chgt', $soapRequest);
  }

  public function fetchSetSeuilConso(SetSeuilConsoInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateSetSeuilConso($inputDto);
    return $this->safeCall('SetSeuilConso', $soapRequest);
  }

  public function fetchGetStatOccupantsGraph(GetStatOccupantsGraphInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetStatOccupantsGraph($inputDto);
    return $this->safeCall('GetStatOccupantsGraph', $soapRequest);
  }

  public function fetchGetInfosAppareilsByLogement(GetInfosAppareilsByLogementInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosAppareilsByLogement($inputDto);
    return $this->safeCall('GetInfosAppareilsByLogement', $soapRequest);
  }

  public function fetchGetInfosLogements(GetInfosLogementsInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosLogements($inputDto);
    return $this->safeCall('GetInfosLogements', $soapRequest);
  }

}
