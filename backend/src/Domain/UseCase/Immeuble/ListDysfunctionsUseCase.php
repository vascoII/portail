<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->listDysfunctionsService($inputDto);
  }
}
