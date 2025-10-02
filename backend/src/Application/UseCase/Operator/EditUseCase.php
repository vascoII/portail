<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Output\Operator\EditOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class EditUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    return $this->serviceDataProvider->editService($inputDto);
  }
}
