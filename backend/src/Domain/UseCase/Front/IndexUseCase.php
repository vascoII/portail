<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Infrastructure\Transformer\FrontTransformer;
use App\Domain\Service\Soap\FrontSoapInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly FrontSoapInterface $service,
    private readonly FrontTransformer $transformer    
  ) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    $serviceResponse = $this->service->indexService($inputDto);
    return $this->transformer->transformIndexResponse($serviceResponse);
  }
}
