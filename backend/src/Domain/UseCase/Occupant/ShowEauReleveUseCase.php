<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowEauReleveUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto
  {
    \assert($inputDto instanceof ShowEauReleveInputDto);
    return new ShowEauReleveOutputDto($inputDto->pkOccupant);
  }
}
