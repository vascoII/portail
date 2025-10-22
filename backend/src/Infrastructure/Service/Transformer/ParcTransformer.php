<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Service\Transformer\ParcTransformerInterface;
use App\Application\Dto\Output\Parc\GetParcOutputDto;

final class ParcTransformer implements ParcTransformerInterface
{
  public function transformGetParc(object $dataSourceResult): GetParcOutputDto
  {
    // TODO: Transform actual response when SOAP method is known
    return new GetParcOutputDto(
      pkParc: 1,
      nom: 'Parc Principal',
      description: 'Description du parc principal',
      actif: true
    );
  }

}
