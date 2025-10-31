<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class GetLogementUseCase
{
    public function __construct(
        private readonly LogementDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): LogementOutputDto
    {
        return $this->serviceDataProvider->getLogementService($inputDto);
    }
}
