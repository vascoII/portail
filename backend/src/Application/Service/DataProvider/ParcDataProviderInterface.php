<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

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

interface ParcDataProviderInterface
{
  public function getParcService(): GetParcOutputDto;
  public function listParcInterventionsService(): ListParcInterventionsOutputDto;
  public function getParcIndicatorsService(): GetParcIndicatorsOutputDto;
  public function getParcCapteurService(): GetParcCapteurOutputDto;
  public function getParcCETService(): GetParcCETOutputDto;
  public function getParcECService(): GetParcECOutputDto;
  public function getParcEFService(): GetParcEFOutputDto;
  public function getParcElectService(): GetParcElectOutputDto;
  public function getParcGazService(): GetParcGazOutputDto;
  public function getParcRepartService(): GetParcRepartOutputDto;
  public function getParcSerieConsosCompteurGeneralService(): GetParcSerieConsosCompteurGeneralOutputDto;
  public function getParcSerieConsosEAUService(): GetParcSerieConsosEAUOutputDto;
}
