<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;

final class InterventionHydrator extends Hydrator
{
    public function hydrateGetCases(GetCasesByEmailInpuDto $inputDto): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'Id' => $inputDto->id,
            'Email' => $inputDto->email,
        ];
    }
}
