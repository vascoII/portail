<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Input\Facture\IndexInputDto;
use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\FactureSoapInterface;

final class IndexUseCase implements UseCaseInterface
{
  public function __construct(private readonly FactureSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
