<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class ViewUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(ViewInputDto $inputDto): ViewOutputDto
  {
    return $this->service->viewService($inputDto);
  }
}
