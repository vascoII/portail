<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\PatchOccupantInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class PatchOccupantUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(PatchOccupantInputDto $inputDto): SuccessOutputDto
    {
        return $this->serviceDataProvider->patchOccupantService($inputDto);
    }
}
