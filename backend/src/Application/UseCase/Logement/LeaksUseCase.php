<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\LeaksInputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class LeaksUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(LeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->serviceDataProvider->listLeaksService($inputDto);
  }
}
