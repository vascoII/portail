<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class GetOccupantReleveEauUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $dataProvider
    ) {}

    public function execute(): SuccessOutputDto
    {
        return $this->dataProvider->getOccupantReleveEauService();
    }
}
