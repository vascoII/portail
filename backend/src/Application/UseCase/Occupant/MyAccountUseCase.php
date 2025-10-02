<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class MyAccountUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(MyAccountInputDto $inputDto): MyAccountOutputDto
  {
    return $this->serviceDataProvider->myAccountService($inputDto);
  }
}
