<?php

declare(strict_types=1);

namespace App\Application\UseCase\Releve;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\ReleveDataProviderInterface;

final class GenerateReleveUseCase
{
    public function __construct(
        private readonly ReleveDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(): SuccessOutputDto
    {
        return $this->serviceDataProvider->listCasesService();
    }
}
