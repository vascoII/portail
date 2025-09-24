<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    $serviceResponse = $this->service->listAnomaliesService($inputDto);
    return $this->transformer->transformListAnomaliesResponse($serviceResponse);
  }
}
