<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Search\IndexInputDto;

interface SearchDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
}
