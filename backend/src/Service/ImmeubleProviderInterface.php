<?php

namespace App\Service;

use App\Dto\ImmeubleDto;

interface ImmeubleProviderInterface
{
  public function getImmeubleById(int $id): ?ImmeubleDto;
  public function requestPdfGeneration(int $immeubleId): bool;
  public function syncWithErp(int $immeubleId, array $data): bool;
}
