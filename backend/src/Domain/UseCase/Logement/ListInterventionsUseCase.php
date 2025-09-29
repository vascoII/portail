<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsService($inputDto);
  }
}
