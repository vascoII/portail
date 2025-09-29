<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsService($inputDto);
  }
}
