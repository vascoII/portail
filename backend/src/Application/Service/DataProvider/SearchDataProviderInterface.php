<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;

interface SearchDataProviderInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
}
