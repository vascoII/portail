<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Input\Releve\GenerateReleveInputDto;
use App\Application\Service\DataProvider\ReleveDataProviderInterface;
use App\Application\Service\DataSource\ReleveDataSourceInterface;
use App\Application\Service\Transformer\ReleveTransformerInterface;

final class ReleveDataProvider implements ReleveDataProviderInterface
{
    public function __construct(
        private readonly ReleveDataSourceInterface $dataSource,
        private readonly ReleveTransformerInterface $transformer
    ) {}

    public function generateReleveService(GenerateReleveInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->dataSource->fetchPostReleve($inputDto);
dd(__FUNCTION__, $rawData);
        return $this->transformer->transformPostReleve($rawData);
    }
}
