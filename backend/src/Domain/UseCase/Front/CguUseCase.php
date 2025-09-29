<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;
use App\Application\Service\DataProvider\FrontDataProviderInterface;

final class CguUseCase
{
  public function __construct(
    private readonly FrontDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CguInputDto $inputDto): CguOutputDto
  {
    return $this->serviceDataProvider->cguService($inputDto);
  }
}
