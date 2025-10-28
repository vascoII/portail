<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Logement\GetImmeubleIdAndLogementIdInputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListInterventionsOutputDto ;
use App\Application\Dto\Output\Shared\ListFuitesOutputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;

interface LogementDataProviderInterface
{

  public function listAnomaliesByLogementService(GetImmeubleIdAndLogementIdInputDto $inputDto): ListAnomaliesOuputDto;
  public function listInterventionsByLogementService(GetImmeubleIdAndLogementIdInputDto $inputDto): ListInterventionsOutputDto ;
  public function listFuitesByLogementService(GetImmeubleIdAndLogementIdInputDto $inputDto): ListFuitesOutputDto;
  public function listDysfonctionnementsByLogementService(GetImmeubleIdAndLogementIdInputDto $inputDto): ListDysfonctionnementsOuputDto;

  public function getLogementService(GetByIdIntInputDto $inputDto): LogementOutputDto;
  public function getLogementCapteurService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getLogementCETService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getLogementECService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getLogementEFService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
  public function getLogementRepartService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto;
}
