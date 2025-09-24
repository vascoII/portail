<?php

declare(strict_types=1);

namespace App\Domain\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Infrastructure\Transformer\TableauBordClientTransformer;
use App\Domain\Service\Soap\TableauBordClientSoapInterface;

final class InterventionUseCase
{
  public function __construct(
    private readonly TableauBordClientSoapInterface $service,
    private readonly TableauBordClientTransformer $transformer
  ) {}

  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    $serviceResponse = $this->service->interventionService($inputDto);
    return $this->transformer->transformInterventionResponse($serviceResponse);
  }
}
