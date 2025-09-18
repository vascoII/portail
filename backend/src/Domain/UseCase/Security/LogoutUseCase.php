<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LogoutInputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class LogoutUseCase implements UseCaseInterface
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LogoutInputDto);
    return new LogoutOutputDto(true);
  }
}
