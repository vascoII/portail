<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class CreateOperationImmeubleUseCase
{
    public function __construct(
        private readonly OperatorDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(CreateOperationImmeubleInputDto $inputDto): SuccessOutputDto
    {
        return $this->serviceDataProvider->createOperationImmeubleService($inputDto);
    }
}
