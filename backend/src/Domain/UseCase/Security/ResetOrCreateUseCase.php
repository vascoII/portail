<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Infrastructure\Transformer\SecurityTransformer;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class ResetOrCreateUseCase
{
  public function __construct(
    private readonly SecuritySoapInterface $service,
    private readonly SecurityTransformer $transformer
  ) {}

  public function execute(ResetOrCreateInputDto $inputDto): ResetOrCreateOutputDto
  {
    $serviceResponse = $this->service->resetOrCreateService($inputDto);
    return $this->transformer->transformResetOrCreateResponse($serviceResponse);
  }
}
