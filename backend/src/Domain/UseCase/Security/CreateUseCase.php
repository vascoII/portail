<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class CreateUseCase implements UseCaseInterface
{
  public function __construct(private readonly SecuritySoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof CreateInputDto);
    return new CreateOutputDto(true);
  }
}
