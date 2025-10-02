<?php

declare(strict_types=1);

namespace App\Application\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ShowUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    return $this->serviceDataProvider->showService($inputDto);
  }
}
