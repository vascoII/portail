<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->listDysfunctionsService($inputDto);
  }
}
