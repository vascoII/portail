<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService($inputDto);
  }
}
