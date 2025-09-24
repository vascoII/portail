<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ListDysfunctionsOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->listDysfunctionsService($inputDto);
    return $this->transformer->transformListDysfunctionsResponse($serviceResponse);
  }
}
