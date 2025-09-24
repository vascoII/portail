<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;
use App\Infrastructure\Transformer\FrontTransformer;
use App\Domain\Service\Soap\FrontSoapInterface;

final class CguUseCase
{
  public function __construct(
    private readonly FrontSoapInterface $service,
    private readonly FrontTransformer $transformer    
  ) {}

  public function execute(CguInputDto $inputDto): CguOutputDto
  {
    $serviceResponse = $this->service->cguService($inputDto);
    return $this->transformer->transformCguResponse($serviceResponse);
  }
}
