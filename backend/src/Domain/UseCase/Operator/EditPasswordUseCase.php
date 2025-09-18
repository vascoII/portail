<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class EditPasswordUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(EditPasswordInputDto $inputDto): EditPasswordOutputDto
  {
    \assert($inputDto instanceof EditPasswordInputDto);
    return new EditPasswordOutputDto(true);
  }
}
