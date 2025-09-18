<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Output\Operator\AddBuildingOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class AddBuildingUseCase implements UseCaseInterface
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof AddBuildingInputDto);
    return new AddBuildingOutputDto(true);
  }
}
