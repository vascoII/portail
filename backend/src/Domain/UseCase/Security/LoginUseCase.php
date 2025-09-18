<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class LoginUseCase implements UseCaseInterface
{
  public function __construct(private readonly SecuritySoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LoginInputDto);

    return new LoginOutputDto(true);
  }
}
