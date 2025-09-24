<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    $serviceResponse = $this->service->indexService($inputDto);
    return $this->transformer->transformIndexResponse($serviceResponse);
  }
}
