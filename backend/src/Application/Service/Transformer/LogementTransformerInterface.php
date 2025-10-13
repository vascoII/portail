<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;

interface LogementTransformerInterface
{
   public function transformListLogements(object $dataSourceResult): ListLogementsOuputDto;
   public function transformGetLogement(object $dataSourceResult): LogementOutputDto;
}
