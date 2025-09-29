<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->serviceDataProvider->listLeaksService($inputDto);
  }
}
