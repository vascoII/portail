<?php

namespace App\Service;

interface ImmeubleSoapProviderInterface
{
  public function getIndicatorsByImmeubleId(int $immeubleId): array;
  public function requestPdfGeneration(int $immeubleId): bool;
  public function syncWithErp(int $immeubleId, array $data): bool;
}
