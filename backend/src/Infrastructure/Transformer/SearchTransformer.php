<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Search\IndexOutputDto;

final class SearchTransformer
{
   /**
   * Transform raw SOAP response to IndexOutputDto
   */
   public function transformIndexResponse(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

}