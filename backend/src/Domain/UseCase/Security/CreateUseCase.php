<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Output\Security\CreateOutputDto;

use App\Domain\Service\Soap\SecuritySoapInterface;

final class CreateUseCase
{
  public function __construct(private readonly SecuritySoapInterface $service) {}

  public function execute(CreateInputDto $inputDto): CreateOutputDto
  {
    \assert($inputDto instanceof CreateInputDto);
    return new CreateOutputDto(true);
  }
}
