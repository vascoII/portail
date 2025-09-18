<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ShowUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    \assert($inputDto instanceof ShowInputDto);
    return new ShowOutputDto($inputDto->pkLogement);
  }
}
