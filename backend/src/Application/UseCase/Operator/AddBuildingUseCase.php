<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Output\Operator\AddBuildingOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class AddBuildingUseCase
{
    public function __construct(
        private readonly OperatorDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(AddBuildingInputDto $inputDto): AddBuildingOutputDto
    {
        return $this->serviceDataProvider->addBuildingService($inputDto);
    }
}
