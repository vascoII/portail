<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LogoutInputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;

use App\Domain\Service\Soap\SecuritySoapInterface;

final class LogoutUseCase
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(LogoutInputDto $inputDto): LogoutOutputDto
  {
    \assert($inputDto instanceof LogoutInputDto);
    return new LogoutOutputDto(true);
  }
}
