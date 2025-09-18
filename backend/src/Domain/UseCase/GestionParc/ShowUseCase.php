<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ShowUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    return $this->service->showService($inputDto);
  }
}
