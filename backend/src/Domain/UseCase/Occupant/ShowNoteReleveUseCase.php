<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowNoteReleveUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto
  {
    return $this->service->showNoteReleveService($inputDto);
  }
}
