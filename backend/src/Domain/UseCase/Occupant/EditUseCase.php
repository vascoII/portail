<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Dto\Output\Occupant\EditOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class EditUseCase
{
   public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    $serviceResponse = $this->service->editService($inputDto);
    return $this->transformer->transformEditResponse($serviceResponse);
  }
}
