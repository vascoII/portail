<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Operator;

use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;

final class EditPasswordUseCase
{
  public function __construct(
    private readonly OperatorDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(EditPasswordInputDto $inputDto): EditPasswordOutputDto
  {
    return $this->serviceDataProvider->editPasswordService($inputDto);
  }
}
