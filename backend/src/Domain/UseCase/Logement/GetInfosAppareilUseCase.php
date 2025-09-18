<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\LogementSoapInterface;

final class GetInfosAppareilUseCase implements UseCaseInterface
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof GetInfosAppareilInputDto);
    return new GetInfosAppareilOutputDto([]);
  }
}
