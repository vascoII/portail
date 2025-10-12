<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOutputDto;
use App\Application\Dto\Output\Logement\GetLogementOutputDto;

interface LogementTransformerInterface
{
   public function transformListLogements(object $dataSourceResult): ListLogementsOutputDto;
   public function transformGetLogement(object $dataSourceResult): GetLogementOutputDto;
}
