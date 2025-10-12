<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListDysfonctionnementsByLogementUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto
  {
    return $this->serviceDataProvider->listDysfonctionnementsByLogementService($inputDto);
  }
}
