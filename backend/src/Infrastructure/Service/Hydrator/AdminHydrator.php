<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Admin\LoginFromParamInputDto;
use App\Application\Dto\Input\Admin\ResetPasswordFromEmailInputDto;
use App\Application\Dto\Input\Admin\UpdateCGUFromPKUserInputDto;
use App\Application\Dto\Input\Admin\UpdateEmailFromPKUserInputDto;

final class AdminHydrator
{
    public function __construct(
        private readonly string $superLoginID,
        private readonly string $superPassword,
        private readonly string $adminSessionId
    ) {}

    public function hydrateGetSousTraitants(): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
        ];
    }

    public function hydrateLoginFromParam(LoginFromParamInputDto $inputDto): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'Param' => $inputDto->param,
        ];
    }

    public function hydrateResetPasswordFromEmail(ResetPasswordFromEmailInputDto $inputDto): object
    {
        return (object) [
            'SessionID' => $this->adminSessionId,
            'PkUser' => -1,
            'Email' => $inputDto->email,
        ];
    }

    public function hydrateUpdateCGUFromPKUser(UpdateCGUFromPKUserInputDto $inputDto): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'PKUser' => $inputDto->pkUser,
            'CGU' => $inputDto->cgu,
        ];
    }

    public function hydrateUpdateEmailFromPKUser(UpdateEmailFromPKUserInputDto $inputDto): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'PKUser' => $inputDto->pkUser,
            'Email' => $inputDto->email,
        ];
    }
}
