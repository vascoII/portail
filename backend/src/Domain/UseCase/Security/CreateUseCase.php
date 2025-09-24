<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Infrastructure\Transformer\SecurityTransformer;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class CreateUseCase
{
  public function __construct(
    private readonly SecuritySoapInterface $service,
    private readonly SecurityTransformer $transformer
  ) {}

  public function execute(CreateInputDto $inputDto): CreateOutputDto
  {
    $serviceResponse = $this->service->createService($inputDto);
    return $this->transformer->transformCreateResponse($serviceResponse);
  }
}
