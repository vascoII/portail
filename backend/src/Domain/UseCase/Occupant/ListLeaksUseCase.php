<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListLeaksUseCase implements UseCaseInterface
{
  public function __construct(private readonly OccupantSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ListLeaksInputDto);
    return new ListLeaksOutputDto([]);
  }
}
