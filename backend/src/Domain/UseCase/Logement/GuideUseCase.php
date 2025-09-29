<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Output\Logement\GuideOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class GuideUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(GuideInputDto $inputDto): GuideOutputDto
  {
    return $this->serviceDataProvider->guideService($inputDto);
  }
}
