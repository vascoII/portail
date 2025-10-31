<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetImmeubleIdAndLogementIdInputDto;
use App\Application\Dto\Output\Shared\ListInterventionsOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListInterventionsByLogementUseCase
{
    public function __construct(
        private readonly LogementDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetImmeubleIdAndLogementIdInputDto $inputDto): ListInterventionsOutputDto
    {
        return $this->serviceDataProvider->listInterventionsByLogementService($inputDto);
    }
}
