<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowEauReleveUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto
  {
    $serviceResponse = $this->service->showEauReleveService($inputDto);
    return $this->transformer->transformShowEauReleveResponse($serviceResponse);
  }
}
