<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ShowNoteReleveUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto
  {
    return $this->serviceDataProvider->showNoteReleveService($inputDto);
  }
}
