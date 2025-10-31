<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class GetLogementGazUseCase
{
    public function __construct(
        private readonly LogementDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        return $this->serviceDataProvider->getLogementGazService($inputDto);
    }
}
