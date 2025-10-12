<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListAlertesOuputDto;
use App\Application\Dto\Output\Occupant\GetOccupantAccountOutputDto;


interface OccupantDataProviderInterface
{

  public function listAnomaliesByOccupantService(): ListAnomaliesOuputDto;
  public function listInterventionsByOccupantService(): ListInternetionsOutputDto;
  public function listFuitesByOccupantService(): ListFuitesOuputDto;
  public function listDysfonctionnementsByOccupantService(): ListDysfonctionnementsOuputDto;
  public function getOccupantService(): GetOccupantOutputDto;
  public function listAlertesByOccupantService(): ListAlertesOuputDto;
  public function getOccupantAccountService(): GetOccupantAccountOutputDto;
}
