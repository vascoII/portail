<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Intervention\ListCasesOutputDto;
use App\Application\Service\Transformer\InterventionTransformerInterface;

final class InterventionTransformer implements InterventionTransformerInterface
{
    /**
     * Transform raw response to ListCasesOutputDto.
     */
    public function transformGetCases(object $dataSourceResult): ListCasesOutputDto
    {
        return new ListCasesOutputDto(true);
    }
}
