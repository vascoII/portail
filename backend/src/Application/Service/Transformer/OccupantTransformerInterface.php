<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Occupant\GetOccupantAccountOutputDto;
use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;

interface OccupantTransformerInterface
{
   public function transformGetOccupantAccount(object $dataSourceResult): GetOccupantAccountOutputDto;
   public function transformGetOccupant(object $dataSourceResult): GetOccupantOutputDto;
}
