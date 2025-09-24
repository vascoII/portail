<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowInterventionUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    $serviceResponse = $this->service->showInterventionService($inputDto);
    return $this->transformer->transformShowInterventionResponse($serviceResponse);
  }
}
