<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class ResetOrCreateUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ResetOrCreateInputDto $inputDto): ResetOrCreateOutputDto
  {
    return $this->serviceDataProvider->resetOrCreateService($inputDto);
  }
}
