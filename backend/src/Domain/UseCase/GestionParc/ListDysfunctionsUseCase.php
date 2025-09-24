<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->listDysfunctionsService($inputDto);
    return $this->transformer->transformListDysfunctionsResponse($serviceResponse);
  }
}
