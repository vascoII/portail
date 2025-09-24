<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ListInterventionsOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    $serviceResponse = $this->service->listInterventionsService($inputDto);
    return $this->transformer->transformListInterventionsResponse($serviceResponse);
  }
}
