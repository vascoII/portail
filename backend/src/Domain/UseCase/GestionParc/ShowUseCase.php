<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ShowUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    $serviceResponse = $this->service->showService($inputDto);
    return $this->transformer->transformShowResponse($serviceResponse);
  }
}
