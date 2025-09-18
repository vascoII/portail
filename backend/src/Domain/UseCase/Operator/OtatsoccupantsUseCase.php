<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;

use App\Domain\Service\Soap\OperatorSoapInterface;

final class OtatsoccupantsUseCase
{
  public function __construct(private readonly OperatorSoapInterface $service) {}

  public function execute(OtatsoccupantsInputDto $inputDto): OtatsoccupantsOutputDto
  {
    return $this->service->otatsoccupantsService($inputDto);
  }
}
