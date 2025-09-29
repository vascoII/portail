<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;

final class TableauBordClientTransformer
{
   /**
    * Transform raw response to IndexOutputDto
    */
   public function transformIndex(object $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
    * Transform raw response to InterventionOutputDto
    */
   public function transformIntervention(object $response): InterventionOutputDto
   {
      return new InterventionOutputDto();
   }
}
