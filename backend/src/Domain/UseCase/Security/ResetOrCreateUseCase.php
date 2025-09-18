<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;

use App\Domain\Service\Soap\SecuritySoapInterface;

final class ResetOrCreateUseCase
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(ResetOrCreateInputDto $inputDto): ResetOrCreateOutputDto
  {
    return $this->service->resetOrCreateService($inputDto);
  }
}
