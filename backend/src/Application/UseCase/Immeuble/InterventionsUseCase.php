<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\InterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class InterventionsUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(InterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsService($inputDto);
  }
}
