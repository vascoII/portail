<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class DeleteUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(DeleteInputDto $inputDto): DeleteOutputDto
  {
    \assert($inputDto instanceof DeleteInputDto);
    return new DeleteOutputDto(true);
  }
}
