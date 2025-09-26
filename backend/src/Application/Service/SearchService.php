<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;
use App\Domain\Service\DataProvider\SearchInterface;

final class SearchService implements SearchInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {

  }
  
}
