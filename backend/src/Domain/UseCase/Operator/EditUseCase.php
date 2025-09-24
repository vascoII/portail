<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Output\Operator\EditOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class EditUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    $serviceResponse = $this->service->editService($inputDto);
    return $this->transformer->transformEditResponse($serviceResponse);
  }
}
