<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class ResetPasswordUseCase implements UseCaseInterface
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ResetPasswordInputDto);

    return new ResetPasswordOutputDto(true);
  }
}
