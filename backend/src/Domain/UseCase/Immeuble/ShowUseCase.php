<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Output\Immeuble\ShowOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ShowUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    \assert($inputDto instanceof ShowInputDto);
    return new ShowOutputDto($inputDto->pkImmeuble);
  }
}
