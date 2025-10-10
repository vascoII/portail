<?php

declare(strict_types=1);

namespace App\Application\UseCase\Immeuble;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOuputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListLogementsByImmeubleUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetByIdIntInputDto $inputDto): ListLogementsOuputDto
  {
    return $this->serviceDataProvider->listLogementsByImmeubleService($inputDto);
  }
}
