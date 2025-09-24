<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ListLeaksOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    $serviceResponse = $this->service->listLeaksService($inputDto);
    return $this->transformer->transformListLeaksResponse($serviceResponse);
  }
}
