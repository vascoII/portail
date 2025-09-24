<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Infrastructure\Transformer\SecurityTransformer;
use App\Domain\Service\Soap\SecuritySoapInterface;

final class UpdatePasswordUseCase
{
  public function __construct(
    private readonly SecuritySoapInterface $service,
    private readonly SecurityTransformer $transformer
  ) {}

  public function execute(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
  {
    $serviceResponse = $this->service->updatePasswordService($inputDto);
    return $this->transformer->transformUpdatePasswordResponse($serviceResponse);
  }
}
