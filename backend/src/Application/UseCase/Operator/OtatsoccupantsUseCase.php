<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class OtatsoccupantsUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(OtatsoccupantsInputDto $inputDto): OtatsoccupantsOutputDto
  {
    return $this->serviceDataProvider->otatsoccupantsService($inputDto);
  }
}
