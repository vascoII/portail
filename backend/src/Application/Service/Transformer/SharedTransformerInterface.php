<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Output\Shared\UserDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListInterventionsOutputDto ;
use App\Application\Dto\Output\Shared\ListAlertesOuputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;

interface SharedTransformerInterface
{
  public function transformPost(bool $dataSourceResult): SuccessOutputDto;
  public function transformPut(object $dataSourceResult): SuccessOutputDto;
  public function transformPatch(object $dataSourceResult): SuccessOutputDto;
  public function transformDelete(object $dataSourceResult): SuccessOutputDto;
  public function transformGetUser(object $dataSourceResult): UserDto;
  public function transformGetReport(string $dataSourceResult, string $filename): GetReportOutputDto;
  public function transformSuccess(): SuccessOutputDto;

  public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOuputDto;
  public function transformListDysfonctionnements(object $dataSourceResult): ListDysfonctionnementsOuputDto;
  public function transformListFuites(object $dataSourceResult): ListFuitesOuputDto;
  public function transformListInterventions(object $dataSourceResult): ListInterventionsOutputDto ;
  public function transformListAlertes(object $dataSourceResult): ListAlertesOuputDto;

  public function transformListImmeublesIndicators(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleIndicators(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleCapteur(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleCET(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleEC(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleEF(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleElect(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleGaz(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleRepart(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleSerieConsosCompteurGeneral(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetImmeubleSerieConsosEAU(object $dataSourceResult): ListIndicatorsOuputDto;

  public function transformListLogementsIndicators(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementIndicators(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementCapteur(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementCET(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementEC(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementEF(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementElect(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementGaz(object $dataSourceResult): ListIndicatorsOuputDto;
  public function transformGetLogementRepart(object $dataSourceResult): ListIndicatorsOuputDto;
}
