<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Parc\GetParcOutputDto;

interface ParcTransformerInterface
{
  public function transformGetParc(object $dataSourceResult): GetParcOutputDto;
  
}
