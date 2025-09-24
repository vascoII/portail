<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Output\Immeuble\InterventionOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class InterventionUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    $serviceResponse = $this->service->interventionService($inputDto);
    return $this->transformer->transformInterventionResponse($serviceResponse);
  }
}
