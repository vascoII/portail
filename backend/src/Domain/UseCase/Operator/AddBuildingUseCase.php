<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Output\Operator\AddBuildingOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class AddBuildingUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(AddBuildingInputDto $inputDto): AddBuildingOutputDto
  {
    $serviceResponse = $this->service->addBuildingService($inputDto);
    return $this->transformer->transformAddBuildingResponse($serviceResponse);
  }
}
