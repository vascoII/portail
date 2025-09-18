<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Output\Immeuble\FilterResultOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class FilterResultUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    return $this->service->filterResultService($inputDto);
  }
}
