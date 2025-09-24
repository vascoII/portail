<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class SimulateurUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(SimulateurInputDto $inputDto): SimulateurOutputDto
  {
    $serviceResponse = $this->service->simulateurService($inputDto);
    return $this->transformer->transformSimulateurResponse($serviceResponse);
  }
}
