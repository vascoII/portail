<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOutputDto;
use App\Application\Dto\Output\Shared\ListInterventionsOutputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;

interface ImmeubleDataProviderInterface
{

  public function listImmeublesService(): ListImmeublesOutputDto;
  
  public function getImmeubleService(GetByIdIntInputDto $inputDto): GetImmeubleOutputDto;
  public function getImmeubleCapteurService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleCETService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleECService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleEFService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleRepartService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getImmeubleSerieConsosEAUService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;

  public function listAnomaliesByImmeubleService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto;
  public function listDysfonctionnementsByImmeubleService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto;
  public function listFuitesByImmeubleService(GetByIdIntInputDto $inputDto): ListFuitesOutputDto;
  public function listInterventionsByImmeubleService(GetByIdIntInputDto $inputDto): ListInterventionsOutputDto;

  public function listLogementsByImmeubleService(GetByIdIntInputDto $inputDto): ListLogementsOuputDto;
  
}
