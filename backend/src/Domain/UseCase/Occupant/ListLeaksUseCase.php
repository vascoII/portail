<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListLeaksUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->service->listLeaksService($inputDto);
  }
}
