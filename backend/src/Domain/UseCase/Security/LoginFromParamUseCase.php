<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Infrastructure\Transformer\SecurityTransformer;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class LoginFromParamUseCase
{
  public function __construct(
    private readonly SecuritySoapInterface $service,
    private readonly SecurityTransformer $transformer
  ) {}

  public function execute(LoginFromParamInputDto $inputDto): LoginOutputDto
  {
    $serviceResponse = $this->service->loginFromParamService($inputDto);
    return $this->transformer->transformLoginFromParamResponse($serviceResponse);
  }
}
