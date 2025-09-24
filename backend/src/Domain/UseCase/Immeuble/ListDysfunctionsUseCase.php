<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->listDysfunctionsService($inputDto);
    return $this->transformer->transformListDysfunctionsResponse($serviceResponse);
  }
}
