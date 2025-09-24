<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowNoteReleveUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto
  {
    $serviceResponse = $this->service->showNoteReleveService($inputDto);
    return $this->transformer->transformShowNoteReleveResponse($serviceResponse);
  }
}
