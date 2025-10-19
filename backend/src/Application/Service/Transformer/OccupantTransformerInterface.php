<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface OccupantTransformerInterface
{
   public function transformGetOccupantReleveEau(object $dataSourceResult): SuccessOutputDto;
   public function transformGetOccupantReleveRepart(object $dataSourceResult): SuccessOutputDto;
   public function transformGetOccupantReleveNote(object $dataSourceResult): SuccessOutputDto;
   public function transformGetOccupantIntervention(object $dataSourceResult): SuccessOutputDto;
}
