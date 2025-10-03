<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Search\IndexOutputDto;
use App\Application\Service\Transformer\SearchTransformerInterface;
use App\Application\Factory\Search\SearchEntityFactory;
use App\Application\Factory\Search\SearchOutputFactory;

final class SearchTransformer implements SearchTransformerInterface
{
   public function __construct(
      private readonly SearchEntityFactory $entityFactory,
      private readonly SearchOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $dataSourceResult): IndexOutputDto
   {
      return new IndexOutputDto();
   }
}
