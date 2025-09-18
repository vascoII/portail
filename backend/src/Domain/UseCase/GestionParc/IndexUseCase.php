<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class IndexUseCase implements UseCaseInterface
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
