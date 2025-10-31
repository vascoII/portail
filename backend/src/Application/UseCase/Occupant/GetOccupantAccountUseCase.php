<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Occupant\GetOccupantAccountOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class GetOccupantAccountUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(): GetOccupantAccountOutputDto
    {
        return $this->serviceDataProvider->getOccupantAccountService();
    }
}
