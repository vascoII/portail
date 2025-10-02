<?php

declare(strict_types=1);

namespace App\Application\UseCase\Front;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Application\Service\DataProvider\FrontDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly FrontDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService($inputDto);
  }
}
