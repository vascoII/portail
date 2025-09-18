<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
