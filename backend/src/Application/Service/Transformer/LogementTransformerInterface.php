<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOutputDto;
use App\Application\Dto\Output\Logement\GetLogementOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;

interface LogementTransformerInterface
{
   public function transformListLogements(object $dataSourceResult): ListLogementsOutputDto;
   public function transformGetLogement(object $dataSourceResult): GetLogementOutputDto;
   public function transformListAnomaliesByLogement(object $dataSourceResult): ListAnomaliesOuputDto;
   public function transformListDysfonctionnementsByLogement(object $dataSourceResult): ListDysfonctionnementsOuputDto;
   public function transformListFuitesByLogement(object $dataSourceResult): ListFuitesOuputDto;
   public function transformListInterventionsByLogement(object $dataSourceResult): ListInternetionsOutputDto;
}
