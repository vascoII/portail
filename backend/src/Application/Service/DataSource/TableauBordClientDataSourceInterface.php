<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;

interface TableauBordClientDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchIntervention(InterventionInputDto $inputDto): object;
}
