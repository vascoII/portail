<?php

declare(strict_types=1);

namespace App\Application\UseCase\Parc;

use App\Application\Dto\Output\Parc\GetParcCapteurOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;

final class GetParcCapteurUseCase
{
  public function __construct(
    private readonly ParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetParcCapteurOutputDto
  {
    return $this->serviceDataProvider->getParcCapteurService();
  }
}
