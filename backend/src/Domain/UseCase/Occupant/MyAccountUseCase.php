<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class MyAccountUseCase implements UseCaseInterface
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof MyAccountInputDto);
    return new MyAccountOutputDto([]);
  }
}
