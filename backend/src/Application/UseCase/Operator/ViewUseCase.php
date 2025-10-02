<?php

declare(strict_types=1);

namespace App\Application\UseCase\Operator;

use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class ViewUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ViewInputDto $inputDto): ViewOutputDto
  {
    return $this->serviceDataProvider->viewService($inputDto);
  }
}
