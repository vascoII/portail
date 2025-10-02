<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->serviceDataProvider->indexService($inputDto);
  }
}
