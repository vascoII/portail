<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    $serviceResponse = $this->service->listInterventionsService($inputDto);
    return $this->transformer->transformListInterventionsResponse($serviceResponse);
  }
}
