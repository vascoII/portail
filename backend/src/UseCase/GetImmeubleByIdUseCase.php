<?php
// src/UseCase/GetImmeubleByIdUseCase.php
namespace App\UseCase;

use App\Dto\ImmeubleDto;
use App\Service\ImmeubleProviderInterface;

class GetImmeubleByIdUseCase
{
  public function __construct(private ImmeubleProviderInterface $provider) {}

  public function execute(int $id): ?ImmeubleDto
  {
    return $this->provider->getImmeubleById($id);
  }
}
