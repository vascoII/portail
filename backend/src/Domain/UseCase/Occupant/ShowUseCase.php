<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowUseInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ShowUseInputDto $inputDto): ShowOutputDto
  {
    return $this->service->showService($inputDto);
  }
}
