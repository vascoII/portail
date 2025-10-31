<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListAnomaliesByImmeubleUseCase
{
    public function __construct(
        private readonly ImmeubleDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto
    {
        return $this->serviceDataProvider->listAnomaliesByImmeubleService($inputDto);
    }
}
