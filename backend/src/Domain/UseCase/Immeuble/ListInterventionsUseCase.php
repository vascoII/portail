<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    $serviceResponse = $this->service->listInterventionsService($inputDto);
    return $this->transformer->transformListInterventionsResponse($serviceResponse);
  }
}
