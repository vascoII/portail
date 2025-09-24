<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ShowInterventionUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    $serviceResponse = $this->service->showInterventionService($inputDto);
    return $this->transformer->transformShowInterventionResponse($serviceResponse);
  }
}
