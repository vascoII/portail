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
    return $this->safeCall('GetTableauBordClient', $soapRequest);
  }

}
