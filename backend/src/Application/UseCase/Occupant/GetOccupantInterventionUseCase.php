<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class GetOccupantInterventionUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $dataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): SuccessOutputDto
    {
        return $this->dataProvider->getOccupantInterventionService($inputDto);
    }
}
