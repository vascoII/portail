<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Input\Facture\IndexInputDto;
use App\Application\Dto\Output\Facture\IndexOutputDto;

use App\Domain\Service\Soap\FactureSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly FactureSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->service->indexService($inputDto);
  }
}
