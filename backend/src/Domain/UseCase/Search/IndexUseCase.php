<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Search;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;
use App\Infrastructure\Transformer\SearchTransformer;
use App\Domain\Service\Soap\SearchSoapInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly SearchSoapInterface $service,
    private readonly SearchTransformer $transformer
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    $serviceResponse = $this->service->indexService($inputDto);
    return $this->transformer->transformIndexResponse($serviceResponse);
  }
}
