<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;

final class TableauBordClientTransformer
{
   /**
    * Transform raw response to GetTableauBordClientOutputDto
    */
   public function transformGetTableauBordClient(object $dataSourceResult): GetTableauBordClientOutputDto
   {
      $result = $dataSourceResult->GetTableauBordClientResult;
      return new GetTableauBordClientOutputDto($result);
   }
}
