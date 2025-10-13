<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListImmeublesIndicatorsUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListIndicatorsOuputDto
  {
    return $this->serviceDataProvider->listImmeublesIndicatorsService();
  }
}
