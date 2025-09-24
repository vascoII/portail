<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    $serviceResponse = $this->service->listLeaksService($inputDto);
    return $this->transformer->transformListLeaksResponse($serviceResponse);
  }
}
