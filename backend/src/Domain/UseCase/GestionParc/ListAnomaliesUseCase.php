<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListAnomaliesUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    \assert($inputDto instanceof ListAnomaliesInputDto);
    return new ListAnomaliesOutputDto([]);
  }
}
