<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class LoginFromParamUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(LoginFromParamInputDto $inputDto): LoginOutputDto
  {
    return $this->serviceDataProvider->loginFromParamService($inputDto);
  }
}
