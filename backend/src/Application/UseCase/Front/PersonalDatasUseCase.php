<?php

declare(strict_types=1);

namespace App\Application\UseCase\Front;

use App\Application\Dto\Output\Admin\ListSousTraitantOutputDto;
use App\Application\Service\DataProvider\FrontDataProviderInterface;

final class PersonalDatasUseCase
{
  public function __construct(
    private readonly FrontDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListSousTraitantOutputDto
  {
    return $this->serviceDataProvider->personalDatasService();
  }
}
