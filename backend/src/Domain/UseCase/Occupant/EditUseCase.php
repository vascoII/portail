<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Dto\Output\Occupant\EditOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class EditUseCase
{
   public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    return $this->serviceDataProvider->editService($inputDto);
  }
}
