<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Output\Immeuble\FilterResultOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class FilterResultUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    $serviceResponse = $this->service->filterResultService($inputDto);
    return $this->transformer->transformFilterResultResponse($serviceResponse);
  }
}
