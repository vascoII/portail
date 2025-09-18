<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ListAnomaliesUseCase implements UseCaseInterface
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ListAnomaliesInputDto);
    return new ListAnomaliesOutputDto([]);
  }
}
