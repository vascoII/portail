<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListImmeublesUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListImmeublesOutputDto
  {
    return $this->serviceDataProvider->listImmeublesService();
  }
}
