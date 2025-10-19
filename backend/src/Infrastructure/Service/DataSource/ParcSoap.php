<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Infrastructure\Service\Hydrator\ParcHydrator;

final class ParcSoap extends Soap implements ParcDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly ParcHydrator $hydrator
  ) {
    parent::__construct($soapClient);
  }

  public function fetchGetParc(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParc();
    return $this->safeCall('GetParc', $soapRequest);
  }

  public function fetchListParcInterventions(): object
  {
    $soapRequest = $this->hydrator->hydrateListParcInterventions();
    return $this->safeCall('ListParcInterventions', $soapRequest);
  }

  public function fetchGetParcIndicators(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcIndicators();
    return $this->safeCall('GetParcIndicators', $soapRequest);
  }

  public function fetchGetParcCapteur(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcCapteur();
    return $this->safeCall('GetParcCapteur', $soapRequest);
  }

  public function fetchGetParcCET(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcCET();
    return $this->safeCall('GetParcCET', $soapRequest);
  }

  public function fetchGetParcEC(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcEC();
    return $this->safeCall('GetParcEC', $soapRequest);
  }

  public function fetchGetParcEF(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcEF();
    return $this->safeCall('GetParcEF', $soapRequest);
  }

  public function fetchGetParcElect(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcElect();
    return $this->safeCall('GetParcElect', $soapRequest);
  }

  public function fetchGetParcGaz(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcGaz();
    return $this->safeCall('GetParcGaz', $soapRequest);
  }

  public function fetchGetParcRepart(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcRepart();
    return $this->safeCall('GetParcRepart', $soapRequest);
  }

  public function fetchGetParcSerieConsosCompteurGeneral(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcSerieConsosCompteurGeneral();
    return $this->safeCall('GetParcSerieConsosCompteurGeneral', $soapRequest);
  }

  public function fetchGetParcSerieConsosEAU(): object
  {
    $soapRequest = $this->hydrator->hydrateGetParcSerieConsosEAU();
    return $this->safeCall('GetParcSerieConsosEAU', $soapRequest);
  }
}
