<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class DeleteUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(DeleteInputDto $inputDto): DeleteOutputDto
  {
    $serviceResponse = $this->service->deleteService($inputDto);
    return $this->transformer->transformDeleteResponse($serviceResponse);
  }
}
