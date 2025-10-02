<?php

declare(strict_types=1);

namespace App\Application\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Service\DataProvider\TableauBordClientDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly TableauBordClientDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService($inputDto);
  }
}
