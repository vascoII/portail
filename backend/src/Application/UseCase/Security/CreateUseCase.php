<?php

declare(strict_types=1);

namespace App\Application\UseCase\Security;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;

final class CreateUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CreateInputDto $inputDto): CreateOutputDto
  {
    return $this->serviceDataProvider->createService($inputDto);
  }
}
