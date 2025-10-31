<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListDysfonctionnementsByImmeubleUseCase
{
    public function __construct(
        private readonly ImmeubleDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto
    {
        return $this->serviceDataProvider->listDysfonctionnementsByImmeubleService($inputDto);
    }
}
