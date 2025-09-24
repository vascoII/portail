<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Output\Immeuble\ShowInterventionOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ShowInterventionUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    $serviceResponse = $this->service->showInterventionService($inputDto);
    return $this->transformer->transformShowInterventionResponse($serviceResponse);
  }
}
