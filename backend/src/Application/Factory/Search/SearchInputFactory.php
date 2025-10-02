<?php

declare(strict_types=1);

namespace App\Application\Factory\Search;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Search\IndexInputDto;

final class SearchInputFactory
{
  public function createIndexFromRequest(Request $request): IndexInputDto
  {
    return new IndexInputDto();
  }
}
