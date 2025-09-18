<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    return $this->service->listInterventionsService($inputDto);
  }
}
