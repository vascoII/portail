<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowRepartReleveUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    return $this->service->showRepartReleveService($inputDto);
  }
}
