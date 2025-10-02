<?php

declare(strict_types=1);

namespace App\Application\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Application\Service\DataProvider\TableauBordClientDataProviderInterface;

final class InterventionUseCase
{
  public function __construct(
    private readonly TableauBordClientDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    return $this->serviceDataProvider->interventionService($inputDto);
  }
}
