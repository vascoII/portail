<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\ParcDataProviderInterface;
use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Application\Service\Transformer\ParcTransformerInterface;
use App\Application\Dto\Output\Parc\GetParcOutputDto;
use App\Application\Dto\Output\Parc\ListParcInterventionsOutputDto;
use App\Application\Dto\Output\Parc\GetParcIndicatorsOutputDto;
use App\Application\Dto\Output\Parc\GetParcCapteurOutputDto;
use App\Application\Dto\Output\Parc\GetParcCETOutputDto;
use App\Application\Dto\Output\Parc\GetParcECOutputDto;
use App\Application\Dto\Output\Parc\GetParcEFOutputDto;
use App\Application\Dto\Output\Parc\GetParcElectOutputDto;
use App\Application\Dto\Output\Parc\GetParcGazOutputDto;
use App\Application\Dto\Output\Parc\GetParcRepartOutputDto;
use App\Application\Dto\Output\Parc\GetParcSerieConsosCompteurGeneralOutputDto;
use App\Application\Dto\Output\Parc\GetParcSerieConsosEAUOutputDto;

final class ParcDataProvider implements ParcDataProviderInterface
{
  public function __construct(
    private readonly ParcDataSourceInterface $dataSource,
    private readonly ParcTransformerInterface $transformer
  ) {}

  public function getParcService(): GetParcOutputDto
  {
    $rawData = $this->dataSource->fetchGetParc();
    return $this->transformer->transformGetParc($rawData);
  }

  public function listParcInterventionsService(): ListParcInterventionsOutputDto
  {
    $rawData = $this->dataSource->fetchListParcInterventions();
    return $this->transformer->transformListParcInterventions($rawData);
  }

  public function getParcIndicatorsService(): GetParcIndicatorsOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcIndicators();
    return $this->transformer->transformGetParcIndicators($rawData);
  }

  public function getParcCapteurService(): GetParcCapteurOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcCapteur();
    return $this->transformer->transformGetParcCapteur($rawData);
  }

  public function getParcCETService(): GetParcCETOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcCET();
    return $this->transformer->transformGetParcCET($rawData);
  }

  public function getParcECService(): GetParcECOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcEC();
    return $this->transformer->transformGetParcEC($rawData);
  }

  public function getParcEFService(): GetParcEFOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcEF();
    return $this->transformer->transformGetParcEF($rawData);
  }

  public function getParcElectService(): GetParcElectOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcElect();
    return $this->transformer->transformGetParcElect($rawData);
  }

  public function getParcGazService(): GetParcGazOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcGaz();
    return $this->transformer->transformGetParcGaz($rawData);
  }

  public function getParcRepartService(): GetParcRepartOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcRepart();
    return $this->transformer->transformGetParcRepart($rawData);
  }

  public function getParcSerieConsosCompteurGeneralService(): GetParcSerieConsosCompteurGeneralOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcSerieConsosCompteurGeneral();
    return $this->transformer->transformGetParcSerieConsosCompteurGeneral($rawData);
  }

  public function getParcSerieConsosEAUService(): GetParcSerieConsosEAUOutputDto
  {
    $rawData = $this->dataSource->fetchGetParcSerieConsosEAU();
    return $this->transformer->transformGetParcSerieConsosEAU($rawData);
  }
}
