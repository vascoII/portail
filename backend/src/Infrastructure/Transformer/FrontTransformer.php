<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Front\CguOutputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;

final class FrontTransformer
{
   /**
   * Transform raw response to CguOutputDto
   */
   public function transformCgu(array $response): CguOutputDto
   {
      return new CguOutputDto();
   }

   /**
   * Transform raw response to IndexOutputDto
   */
   public function transformIndex(array $response): IndexOutputDto
   {
      return new IndexOutputDto();
   }

   /**
   * Transform raw response to CguOutputDto
   */
   public function transformPersonalData(array $response): PersonalDatasOutputDto
   {
      return new PersonalDatasOutputDto();
   }

   /**
   * Transform raw response to CguOutputDto
   */
   public function transformLegalNotices(array $response): LegalNoticesOutputDto
   {
      return new LegalNoticesOutputDto();
   }

}