<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Logement\GetLogementOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface LogementDataProviderInterface
{

  public function listAnomaliesByLogementService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto;
  public function listInterventionsByLogementService(GetByIdIntInputDto $inputDto): ListInternetionsOutputDto;
  public function listFuitesByLogementService(GetByIdIntInputDto $inputDto): ListFuitesOuputDto;
  public function listDysfonctionnementsByLogementService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto;
  public function getLogementService(GetByIdIntInputDto $inputDto): GetLogementOutputDto;
}
