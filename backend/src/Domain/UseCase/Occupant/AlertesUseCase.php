<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class AlertesUseCase implements UseCaseInterface
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof AlertesInputDto);
    return new AlertesOutputDto([]);
  }
}
