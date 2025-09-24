<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;
use App\Infrastructure\Transformer\OperatorTransformer;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class ViewUseCase
{
  public function __construct(
    private readonly OperatorSoapInterface $service,
    private readonly OperatorTransformer $transformer
  ) {}

  public function execute(ViewInputDto $inputDto): ViewOutputDto
  {
    $serviceResponse = $this->service->viewService($inputDto);
    return $this->transformer->transformViewResponse($serviceResponse);
  }
}
