<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListFuitesOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListFuitesByImmeubleUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdIntInputDto $inputDto): ListFuitesOutputDto
  {
    return $this->serviceDataProvider->listFuitesByImmeubleService($inputDto);
  }
}
