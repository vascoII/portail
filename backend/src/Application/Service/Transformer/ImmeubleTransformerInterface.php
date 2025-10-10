<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Immeuble\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Immeuble\ListFuitesOuputDto;
use App\Application\Dto\Output\Immeuble\ListInternetionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOuputDto;

interface ImmeubleTransformerInterface
{
   public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto;
   public function transformGetImmeuble(object $dataSourceResult): GetImmeubleOutputDto;
   public function transformListAnomaliesByImmeuble(object $dataSourceResult): ListAnomaliesOuputDto;
   public function transformListDysfonctionnementsByImmeuble(object $dataSourceResult): ListDysfonctionnementsOuputDto;
   public function transformListFuitesByImmeuble(object $dataSourceResult): ListFuitesOuputDto;
   public function transformListInterventionsByImmeuble(object $dataSourceResult): ListInternetionsOutputDto;
   public function transformListLogementsByImmeuble(object $dataSourceResult): ListLogementsOuputDto;
}
