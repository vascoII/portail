<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class OtatsoccupantsUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(OtatsoccupantsInputDto $inputDto): OtatsoccupantsOutputDto
  {
    $serviceResponse = $this->service->otatsoccupantsService($inputDto);
    return $this->transformer->transformOtatsoccupantsResponse($serviceResponse);
  }
}
