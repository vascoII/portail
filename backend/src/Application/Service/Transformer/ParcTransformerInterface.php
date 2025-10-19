<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

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

interface ParcTransformerInterface
{
  public function transformGetParc(object $dataSourceResult): GetParcOutputDto;
  public function transformListParcInterventions(object $dataSourceResult): ListParcInterventionsOutputDto;
  public function transformGetParcIndicators(object $dataSourceResult): GetParcIndicatorsOutputDto;
  public function transformGetParcCapteur(object $dataSourceResult): GetParcCapteurOutputDto;
  public function transformGetParcCET(object $dataSourceResult): GetParcCETOutputDto;
  public function transformGetParcEC(object $dataSourceResult): GetParcECOutputDto;
  public function transformGetParcEF(object $dataSourceResult): GetParcEFOutputDto;
  public function transformGetParcElect(object $dataSourceResult): GetParcElectOutputDto;
  public function transformGetParcGaz(object $dataSourceResult): GetParcGazOutputDto;
  public function transformGetParcRepart(object $dataSourceResult): GetParcRepartOutputDto;
  public function transformGetParcSerieConsosCompteurGeneral(object $dataSourceResult): GetParcSerieConsosCompteurGeneralOutputDto;
  public function transformGetParcSerieConsosEAU(object $dataSourceResult): GetParcSerieConsosEAUOutputDto;
}
