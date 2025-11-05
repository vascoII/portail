<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface ReleveTransformerInterface
{
    /**
     * Transform raw response to SuccessOutputDto.
     */
    public function transformPostReleve(object $dataSourceResult): SuccessOutputDto;
}
