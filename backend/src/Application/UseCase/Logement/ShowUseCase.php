<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ShowUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    return $this->serviceDataProvider->showService($inputDto);
  }
}
