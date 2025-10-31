<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class DeleteUseCase
{
    public function __construct(
        private readonly OperatorDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): SuccessOutputDto
    {
        return $this->serviceDataProvider->deleteOperatorService($inputDto);
    }
}
