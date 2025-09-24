<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ListDysfunctionsOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->listDysfunctionsService($inputDto);
    return $this->transformer->transformListDysfunctionsResponse($serviceResponse);
  }
}
