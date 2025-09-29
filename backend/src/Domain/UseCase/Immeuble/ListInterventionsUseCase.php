<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsService($inputDto);
  }
}
