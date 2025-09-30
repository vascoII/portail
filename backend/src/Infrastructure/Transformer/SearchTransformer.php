<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Search\IndexOutputDto;

final class SearchTransformer
{
   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $dataSourceResult): IndexOutputDto
   {
      return new IndexOutputDto();
   }
}
