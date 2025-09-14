<?php

namespace App\UseCase;

use App\Service\ImmeubleSoapProviderInterface;

class RequestPdfGenerationUseCase
{
  public function __construct(private ImmeubleSoapProviderInterface $provider) {}

  public function execute(int $immeubleId): bool
  {
    return $this->provider->requestPdfGeneration($immeubleId);
  }
}
