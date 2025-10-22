<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Parc\GetParcOutputDto;

interface ParcDataProviderInterface
{
  public function getParcService(): GetParcOutputDto;
}
