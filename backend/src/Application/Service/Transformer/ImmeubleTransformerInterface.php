<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;

interface ImmeubleTransformerInterface
{
   public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto;
   public function transformGetImmeuble(object $dataSourceResult): GetImmeubleOutputDto;
   
}
