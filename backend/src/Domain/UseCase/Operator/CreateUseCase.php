<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Output\Operator\CreateOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class CreateUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(CreateInputDto $inputDto): CreateOutputDto
  {
    $serviceResponse = $this->service->createService($inputDto);
    return $this->transformer->transformCreateResponse($serviceResponse);
  }
}
