<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto ;

final class ExternalHydrator
{
    public function __construct(
        private readonly string $superLoginID,
        private readonly string $superPassword,
        private readonly string $adminSessionId
    ) {}

    public function hydrateGetReportByToken(GetByIdStringInputDto  $inputDto): object
    {  
        return (object) [
            'SessionID' => $this->adminSessionId,
            'tokenid' => $inputDto->id,
        ];
    }

}
