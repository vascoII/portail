<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OperatorSoapInterface;

final class EditPasswordUseCase implements UseCaseInterface
{
  public function __construct(private readonly OperatorSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof EditPasswordInputDto);
    return new EditPasswordOutputDto(true);
  }
}
