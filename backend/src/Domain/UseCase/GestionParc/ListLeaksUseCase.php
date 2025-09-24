<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    $serviceResponse = $this->service->listLeaksService($inputDto);
    return $this->transformer->transformListLeaksResponse($serviceResponse);
  }
}
