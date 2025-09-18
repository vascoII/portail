<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;

use App\Domain\Service\Soap\SecuritySoapInterface;

final class LoginUseCase
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(LoginInputDto $inputDto): LoginOutputDto
  {
    \assert($inputDto instanceof LoginInputDto);

    return new LoginOutputDto(true);
  }
}
