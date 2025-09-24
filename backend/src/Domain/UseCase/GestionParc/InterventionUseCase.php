<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class InterventionUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    $serviceResponse = $this->service->interventionService($inputDto);
    return $this->transformer->transformInterventionResponse($serviceResponse);
  }
}
