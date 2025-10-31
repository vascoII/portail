<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;

interface FrontTransformerInterface
{
    /**
     * Transform raw response to CguOutputDto.
     */
    public function transformPersonalData(object $dataSourceResult): GetSousTraitantsOutputDto;
}
