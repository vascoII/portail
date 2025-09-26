<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;

interface SearchInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
}
