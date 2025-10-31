<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\PostOccupantInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class PostOccupantUseCase
{
    public function __construct(
        private readonly OccupantDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(PostOccupantInputDto $inputDto): SuccessOutputDto
    {
        return $this->serviceDataProvider->postOccupantService($inputDto);
    }
}
