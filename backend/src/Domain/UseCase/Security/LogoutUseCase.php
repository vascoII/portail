<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Infrastructure\Transformer\SecurityTransformer;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class LogoutUseCase
{
  public function __construct(
    private readonly SecuritySoapInterface $service,
    private readonly SecurityTransformer $transformer
  ) {}

  public function execute(): LogoutOutputDto
  {
    $soapResponse = $this->service->logoutService();
    return $this->transformer->transformLogoutResponse($soapResponse);
  }
}
