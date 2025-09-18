<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;
use App\Domain\Service\Soap\SearchSoapInterface;

final class SearchSoap implements SearchSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto([]);
  }
}
