<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class GetInfosAppareilUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetInfosAppareilInputDto $inputDto): GetInfosAppareilOutputDto
  {
    return $this->serviceDataProvider->getInfosAppareilService($inputDto);
  }
}
