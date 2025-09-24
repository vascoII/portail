<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class RemoveBuildingUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(RemoveBuildingInputDto $inputDto): RemoveBuildingOutputDto
  {
    $serviceResponse = $this->service->removeBuildingService($inputDto);
    return $this->transformer->transformRemoveBuildingResponse($serviceResponse);
  }
}
