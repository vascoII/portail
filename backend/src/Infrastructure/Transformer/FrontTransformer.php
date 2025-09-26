<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Front\CguOutputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;

final class FrontTransformer
{
   /**
   * Transform raw SOAP response to CguOutputDto
   */
   public function transformCguResponse(array $response): CguOutputDto
   {
      return new CguOutputDto();
   }

   /**
   * Transform raw SOAP response to IndexOutputDto
   */
   public function transformIndexResponse(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw SOAP response to CguOutputDto
   */
   public function transformPersonalDataResponse(array $response): PersonalDatasOutputDto
   {
      return new PersonalDatasOutputDto();
   }

}