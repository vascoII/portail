<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListInterventionsByLogementUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdIntInputDto $inputDto): ListInternetionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsByLogementService($inputDto);
  }
}
