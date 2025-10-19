<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Infrastructure\Service\Hydrator\OccupantHydrator;

final class OccupantSoap extends Soap implements OccupantDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly OccupantHydrator $hydrator
  ) {
    parent::__construct($soapClient);
  }

  public function fetchGetOccupantReleveEau(): object
  {
    $soapRequest = $this->hydrator->hydrateGetOccupantReleveEau();
    return $this->safeCall('GetOccupantReleveEau', $soapRequest);
  }

  public function fetchGetOccupantReleveRepart(): object
  {
    $soapRequest = $this->hydrator->hydrateGetOccupantReleveRepart();
    return $this->safeCall('GetOccupantReleveRepart', $soapRequest);
  }

  public function fetchGetOccupantReleveNote(GetByEnergyStringInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateGetOccupantReleveNote($inputDto);
    return $this->safeCall('GetOccupantReleveNote', $soapRequest);
  }

  public function fetchGetOccupantIntervention(GetByIdIntInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateGetOccupantIntervention($inputDto);
    return $this->safeCall('GetOccupantIntervention', $soapRequest);
  }
}
