<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Output\Immeuble\ShowOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ShowUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    return $this->serviceDataProvider->showService($inputDto);
  }
}
