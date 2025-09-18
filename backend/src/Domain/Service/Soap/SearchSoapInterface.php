<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;

interface SearchSoapInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
}
