<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetImmeubleIdAndLogementIdInputDto;
use App\Application\Dto\Output\Shared\ListFuitesOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListFuitesByLogementUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetImmeubleIdAndLogementIdInputDto $inputDto): ListFuitesOutputDto
  {
    return $this->serviceDataProvider->listFuitesByLogementService($inputDto);
  }
}
