<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowRepartReleveUseCase implements UseCaseInterface
{
  public function __construct(private readonly OccupantSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowRepartReleveInputDto);
    return new ShowRepartReleveOutputDto($inputDto->pkOccupant, $inputDto->pkImmeuble);
  }
}
