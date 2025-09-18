<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Output\Operator\AddBuildingOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class AddBuildingUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(AddBuildingInputDto $inputDto): AddBuildingOutputDto
  {
    \assert($inputDto instanceof AddBuildingInputDto);
    return new AddBuildingOutputDto(true);
  }
}
