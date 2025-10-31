<?php

declare(strict_types=1);

namespace App\Application\UseCase\Search;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;
use App\Application\Service\DataProvider\SearchDataProviderInterface;

final class IndexUseCase
{
    public function __construct(
        private readonly SearchDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(IndexInputDto $inputDto): IndexOutputDto
    {
        return $this->serviceDataProvider->indexService($inputDto);
    }
}
