<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;

final class ExternalHydrator extends Hydrator
{
    public function hydrateGetReportByToken(GetByIdStringInputDto $inputDto): object
    {
        return (object) [
            'SessionID' => $this->adminSessionId,
            'tokenid' => $inputDto->id,
        ];
    }
}
