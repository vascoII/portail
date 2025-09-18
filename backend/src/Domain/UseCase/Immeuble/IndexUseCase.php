<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->service->indexService($inputDto);
  }
}
