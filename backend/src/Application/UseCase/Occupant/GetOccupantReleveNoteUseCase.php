<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class GetOccupantReleveNoteUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $dataProvider
    ) {}

    public function execute(GetByEnergyStringInputDto $inputDto): SuccessOutputDto
    {
        return $this->dataProvider->getOccupantReleveNoteService($inputDto);
    }
}
