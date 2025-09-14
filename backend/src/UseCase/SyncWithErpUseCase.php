<?php

namespace App\UseCase;

use App\Service\ImmeubleSoapProviderInterface;

class SyncWithErpUseCase
{
  public function __construct(private ImmeubleSoapProviderInterface $provider) {}

  /**
   * @param array $data : payload pour la synchro ERP
   */
  public function execute(int $immeubleId, array $data): bool
  {
    return $this->provider->syncWithErp($immeubleId, $data);
  }
}
