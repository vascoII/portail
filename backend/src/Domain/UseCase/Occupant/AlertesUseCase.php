<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class AlertesUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(AlertesInputDto $inputDto): AlertesOutputDto
  {
    $serviceResponse = $this->service->alertesService($inputDto);
    return $this->transformer->transformAlertesResponse($serviceResponse);
  }
}
