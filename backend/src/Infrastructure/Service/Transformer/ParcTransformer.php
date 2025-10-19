<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

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

final class ParcTransformer implements ParcTransformerInterface
{
  public function transformGetParc(object $dataSourceResult): GetParcOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcOutputDto(
      pkParc: 1,
      nom: 'Parc Principal',
      description: 'Description du parc principal',
      actif: true
    );
  }

  public function transformListParcInterventions(object $dataSourceResult): ListParcInterventionsOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new ListParcInterventionsOutputDto(interventions: []);
  }

  public function transformGetParcIndicators(object $dataSourceResult): GetParcIndicatorsOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcIndicatorsOutputDto(
      totalInterventions: 0,
      totalAnomalies: 0,
      totalDysfonctionnements: 0,
      totalFuites: 0
    );
  }

  public function transformGetParcCapteur(object $dataSourceResult): GetParcCapteurOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcCapteurOutputDto(capteurs: []);
  }

  public function transformGetParcCET(object $dataSourceResult): GetParcCETOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcCETOutputDto(
      consommation: 0.0,
      unite: 'kWh',
      dateDebut: null,
      dateFin: null
    );
  }

  public function transformGetParcEC(object $dataSourceResult): GetParcECOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcECOutputDto(
      consommation: 0.0,
      unite: 'kWh',
      dateDebut: null,
      dateFin: null
    );
  }

  public function transformGetParcEF(object $dataSourceResult): GetParcEFOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcEFOutputDto(
      consommation: 0.0,
      unite: 'kWh',
      dateDebut: null,
      dateFin: null
    );
  }

  public function transformGetParcElect(object $dataSourceResult): GetParcElectOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcElectOutputDto(
      consommation: 0.0,
      unite: 'kWh',
      dateDebut: null,
      dateFin: null
    );
  }

  public function transformGetParcGaz(object $dataSourceResult): GetParcGazOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcGazOutputDto(
      consommation: 0.0,
      unite: 'm³',
      dateDebut: null,
      dateFin: null
    );
  }

  public function transformGetParcRepart(object $dataSourceResult): GetParcRepartOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcRepartOutputDto(repartitions: []);
  }

  public function transformGetParcSerieConsosCompteurGeneral(object $dataSourceResult): GetParcSerieConsosCompteurGeneralOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcSerieConsosCompteurGeneralOutputDto(seriesConsos: []);
  }

  public function transformGetParcSerieConsosEAU(object $dataSourceResult): GetParcSerieConsosEAUOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcSerieConsosEAUOutputDto(seriesConsos: []);
  }
}
