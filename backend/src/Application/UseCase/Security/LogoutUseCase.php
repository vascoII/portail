<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class LogoutUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): LogoutOutputDto
  {
    return $this->serviceDataProvider->logoutService();
  }
}
