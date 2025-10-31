<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListAnomaliesByOccupantUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(): ListAnomaliesOuputDto
    {
        return $this->serviceDataProvider->listAnomaliesByOccupantService();
    }
}
