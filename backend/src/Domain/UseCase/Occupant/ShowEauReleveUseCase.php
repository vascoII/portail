<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowEauReleveUseCase implements UseCaseInterface
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowEauReleveInputDto);
    return new ShowEauReleveOutputDto($inputDto->pkOccupant);
  }
}
