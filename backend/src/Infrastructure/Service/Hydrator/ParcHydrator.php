<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

final class ParcHydrator extends Hydrator
{
    public function hydrateGetParc(): object
    {
        return (object) [
            // TODO: Add specific parameters when SOAP method is known
        ];
    }
}
