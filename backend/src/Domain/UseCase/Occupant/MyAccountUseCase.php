<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class MyAccountUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(MyAccountInputDto $inputDto): MyAccountOutputDto
  {
    return $this->service->myAccountService($inputDto);
  }
}
