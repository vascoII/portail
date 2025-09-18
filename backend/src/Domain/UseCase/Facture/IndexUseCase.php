<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Domain\Service\Soap\FactureSoapInterface;
use App\Infrastructure\Transformer\FactureTransformer;

final class IndexUseCase
{
  public function __construct(
    private readonly FactureSoapInterface $soapService,
    private readonly FactureTransformer $transformer
  ) {}

  public function execute(): IndexOutputDto
  {
    $soapResponse = $this->soapService->indexService();
    return $this->transformer->transformIndexResponse($soapResponse);
  }
}
