<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Output\Operator\EditOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class EditUseCase implements UseCaseInterface
{
  public function __construct(private readonly OperatorSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof EditInputDto);
    return new EditOutputDto(true);
  }
}
