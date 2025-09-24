<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class GetInfosAppareilUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(GetInfosAppareilInputDto $inputDto): GetInfosAppareilOutputDto
  {
    $serviceResponse = $this->service->getInfosAppareilService($inputDto);
    return $this->transformer->transformGetInfosAppareilResponse($serviceResponse); 
  }
}
