<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;

final class InterventionHydrator
{
    public function __construct(
        private readonly string $superLoginID,
        private readonly string $superPassword,
        private readonly string $adminSessionId
    ) {}

    public function hydrateGetCases(GetCasesByEmailInpuDto $inputDto): object
    {
       return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'Id' => $inputDto->id,
            'Email' => $inputDto->email
        ];
    }
}
