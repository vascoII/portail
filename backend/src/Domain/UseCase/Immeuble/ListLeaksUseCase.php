<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ListLeaksOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->serviceDataProvider->listLeaksService($inputDto);
  }
}
