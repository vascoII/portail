<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\ReleveDataProviderInterface;
use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Application\Service\Transformer\ParcTransformerInterface;

final class ReleveDataProvider implements ReleveDataProviderInterface
{
    public function __construct(
        private readonly ParcDataSourceInterface $dataSource,
        private readonly ParcTransformerInterface $transformer
    ) {}

    public function listCasesService(): SuccessOutputDto
    {
        return new SuccessOutputDto(true);
    }
}
