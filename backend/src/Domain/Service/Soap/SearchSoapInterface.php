<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Search\IndexInputDto;

interface SearchSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
}
