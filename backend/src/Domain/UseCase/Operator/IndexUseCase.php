<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class IndexUseCase implements UseCaseInterface
{
  public function __construct(private readonly OperatorSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
