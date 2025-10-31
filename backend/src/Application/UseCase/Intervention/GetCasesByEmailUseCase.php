<?php

declare(strict_types=1);

namespace App\Application\UseCase\Intervention;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;
use App\Application\Dto\Output\Intervention\ListCasesOutputDto;
use App\Application\Service\DataProvider\InterventionDataProviderInterface;

final class GetCasesByEmailUseCase
{
    public function __construct(
        private readonly InterventionDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetCasesByEmailInpuDto $inputDto): ListCasesOutputDto
    {
        return $this->serviceDataProvider->listCasesService($inputDto);
    }
}
