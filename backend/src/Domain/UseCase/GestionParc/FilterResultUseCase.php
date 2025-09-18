<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class FilterResultUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}
  
  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    \assert($inputDto instanceof FilterResultInputDto);
    return new FilterResultOutputDto([]);
  }
}
