<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Input\Security\PatchEmailInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class PatchEmailUseCase
{
    public function __construct(
        private readonly SecurityDataProviderInterface $serviceDataProvider,
        private readonly AuthServiceInterface $authService
    ) {}

    public function execute(PatchEmailInputDto $inputDto): SuccessOutputDto
    {
        return $this->serviceDataProvider->patchEmailService($inputDto);
    }
}
