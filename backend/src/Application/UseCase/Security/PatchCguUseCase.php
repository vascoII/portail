<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use Symfony\Component\HttpFoundation\Request;

final class PatchCguUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider,
    private readonly AuthServiceInterface $authService
  ) {}

  public function execute(): SuccessOutputDto
  {
    return $this->serviceDataProvider->patchCguService();
  }
}
