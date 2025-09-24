<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Output\Immeuble\ShowOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ShowUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    $serviceResponse = $this->service->showService($inputDto);
    return $this->transformer->transformShowResponse($serviceResponse);
  }
}
