<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Application\Service\DataProvider\FrontDataProviderInterface;

final class PersonalDatasUseCase
{
  public function __construct(
    private readonly FrontDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(PersonalDatasInputDto $inputDto): PersonalDatasOutputDto
  {
    return $this->serviceDataProvider->personalDatasService($inputDto);
  }
}
