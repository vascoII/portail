<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOuputDto;


interface ImmeubleDataProviderInterface
{

  public function listImmeublesService(): ListImmeublesOutputDto;
  public function listImmeublesIndicatorsService(): ListIndicatorsOuputDto;

  public function getImmeubleService(GetByIdIntInputDto $inputDto): GetImmeubleOutputDto;
  public function getImmeubleIndicatorsService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleCapteurService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleCETService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleECService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleEFService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleElectService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleGazService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleRepartService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleSerieConsosCompteurGeneralService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleSerieConsosEAUService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;

  public function listAnomaliesByImmeubleService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto;
  public function listDysfonctionnementsByImmeubleService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto;
  public function listFuitesByImmeubleService(GetByIdIntInputDto $inputDto): ListFuitesOuputDto;
  public function listInterventionsByImmeubleService(GetByIdIntInputDto $inputDto): ListInternetionsOutputDto;
  public function listLogementsByImmeubleService(GetByIdIntInputDto $inputDto): ListLogementsOuputDto;
}
