<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\Transformer\ReleveTransformerInterface;

final class ReleveTransformer implements ReleveTransformerInterface
{
    /**
     * Transform raw response to SuccessOutputDto.
     */
    public function transformPostReleve(object $dataSourceResult): SuccessOutputDto
    {
        $sousTraitants = [];
        if (is_array($dataSourceResult->GetSousTraitantsResult)) {
            foreach ($dataSourceResult->GetSousTraitantsResult as $sousTraitant) {
                $sousTraitants[] = $sousTraitant;
            }
        }

        return new SuccessOutputDto(true);
    }
}
