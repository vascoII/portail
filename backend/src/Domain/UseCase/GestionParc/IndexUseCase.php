<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
