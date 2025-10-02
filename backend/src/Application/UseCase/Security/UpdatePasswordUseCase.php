<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class UpdatePasswordUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
  {
    return $this->serviceDataProvider->updatePasswordService($inputDto);
  }
}
