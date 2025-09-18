<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListLeaksUseCase implements UseCaseInterface
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ListLeaksInputDto);
    return new ListLeaksOutputDto([]);
  }
}
