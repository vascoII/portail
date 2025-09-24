<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ShowRepartReleveUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    $serviceResponse = $this->service->showRepartReleveService($inputDto);
     return $this->transformer->transformShowRepartReleveResponse($serviceResponse);
  }
}
