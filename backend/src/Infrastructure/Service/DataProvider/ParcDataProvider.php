<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\ParcDataProviderInterface;
use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Application\Service\Transformer\ParcTransformerInterface;
use App\Application\Dto\Output\Parc\GetParcOutputDto;

final class ParcDataProvider implements ParcDataProviderInterface
{
  public function __construct(
    private readonly ParcDataSourceInterface $dataSource,
    private readonly ParcTransformerInterface $transformer
  ) {}

  public function getParcService(): GetParcOutputDto
  {
    $rawData = $this->dataSource->fetchGetParc();
    return $this->transformer->transformGetParc($rawData);
  }

}
