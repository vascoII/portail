<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    $serviceResponse = $this->service->indexService($inputDto);
    return $this->transformer->transformIndexResponse($serviceResponse);
  }
}
