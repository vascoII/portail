<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;

final class TableauBordClientTransformer
{
   /**
   * Transform raw SOAP response to IndexOutputDto
   */
   public function transformIndexResponse(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw SOAP response to InterventionOutputDto
   */
   public function transformInterventionResponse(array $response): InterventionOutputDto
   {
      return new InterventionOutputDto();
   }

}