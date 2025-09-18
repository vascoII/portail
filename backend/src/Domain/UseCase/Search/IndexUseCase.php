<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Search;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;

use App\Domain\Service\Soap\SearchSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly SearchSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->service->indexService($inputDto);
  }
}
