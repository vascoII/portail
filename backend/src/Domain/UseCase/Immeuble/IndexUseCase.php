<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class IndexUseCase implements UseCaseInterface
{
  public function __construct(private readonly ImmeubleSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
