<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;
use App\Application\Service\DataProvider\FrontDataProviderInterface;

final class LegalNoticesUseCase
{
  public function __construct(
    private readonly FrontDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(LegalNoticesInputDto $inputDto): LegalNoticesOutputDto
  {
    return $this->serviceDataProvider->legalNoticesService($inputDto);
  }
}
