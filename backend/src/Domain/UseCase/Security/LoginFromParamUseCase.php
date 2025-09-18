<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class LoginFromParamUseCase implements UseCaseInterface
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LoginFromParamInputDto);
    return new LoginOutputDto(true);
  }
}
