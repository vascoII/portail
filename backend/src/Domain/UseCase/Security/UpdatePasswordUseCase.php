<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;

use App\Domain\Service\Soap\SecuritySoapInterface;

final class UpdatePasswordUseCase
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
  {
    \assert($inputDto instanceof UpdatePasswordInputDto);
    return new UpdatePasswordOutputDto(true);
  }
}
