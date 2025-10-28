<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;

interface ImmeubleTransformerInterface
{
   public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto;
   public function transformGetImmeuble(object $dataSourceResult): GetImmeubleOutputDto;
   public function transformGetImmeubleCapteur(object $dataSourceResult): ListIndicatorsOuputDto;
   public function transformGetImmeubleCET(object $dataSourceResult): ListIndicatorsOuputDto;
   public function transformGetImmeubleEC(object $dataSourceResult): ListIndicatorsOuputDto;
   public function transformGetImmeubleEF(object $dataSourceResult): ListIndicatorsOuputDto;
   public function transformGetImmeubleRepart(object $dataSourceResult): ListIndicatorsOuputDto;
   public function transformGetImmeubleSerieConsosEAU(object $dataSourceResult): ListIndicatorsOuputDto;
}
