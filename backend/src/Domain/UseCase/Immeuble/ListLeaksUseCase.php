<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ListLeaksOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListLeaksUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->service->listLeaksService($inputDto);
  }
}
