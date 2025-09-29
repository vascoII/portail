<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class DeleteUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(DeleteInputDto $inputDto): DeleteOutputDto
  {
    return $this->serviceDataProvider->deleteService($inputDto);
  }
}
