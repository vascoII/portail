<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class GetImmeubleUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdIntInputDto $inputDto): GetImmeubleOutputDto
  {
    return $this->serviceDataProvider->getImmeubleService($inputDto);
  }
}
