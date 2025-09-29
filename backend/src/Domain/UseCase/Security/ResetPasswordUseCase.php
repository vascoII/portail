<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class ResetPasswordUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ResetPasswordInputDto $inputDto): ResetPasswordOutputDto
  {
    return $this->serviceDataProvider->resetPasswordService($inputDto);
  }
}
