<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class RemoveBuildingUseCase implements UseCaseInterface
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof RemoveBuildingInputDto);
    return new RemoveBuildingOutputDto(true);
  }
}
