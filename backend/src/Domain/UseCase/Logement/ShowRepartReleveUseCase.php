<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ShowRepartReleveUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    return $this->serviceDataProvider->showRepartReleveService($inputDto);
  }
}
