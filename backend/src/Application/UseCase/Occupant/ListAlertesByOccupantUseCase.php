<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\ListAlertesOuputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListAlertesByOccupantUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(): ListAlertesOuputDto
    {
        return $this->serviceDataProvider->listAlertesByOccupantService();
    }
}
