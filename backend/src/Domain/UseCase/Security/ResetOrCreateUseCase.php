<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class ResetOrCreateUseCase implements UseCaseInterface
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ResetOrCreateInputDto);
    return new ResetOrCreateOutputDto(true);
  }
}
