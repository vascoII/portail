<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class LoginUseCase
{
    public function __construct(
        private readonly SecurityDataProviderInterface $serviceDataProvider
    ) {}

    public function execute(LoginInputDto $inputDto): LoginOutputDto
    {
        // Delegate to data provider; let exceptions bubble to be handled centrally
        return $this->serviceDataProvider->loginService($inputDto);
    }
}
