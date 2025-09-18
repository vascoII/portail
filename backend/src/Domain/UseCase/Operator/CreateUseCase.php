<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Output\Operator\CreateOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class CreateUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(CreateInputDto $inputDto): CreateOutputDto
  {
    return $this->service->createService($inputDto);
  }
}
