<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    \assert($inputDto instanceof ListDysfunctionsInputDto);
    return new ListDysfunctionsOutputDto([]);
  }
}
