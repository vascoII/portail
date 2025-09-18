<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    \assert($inputDto instanceof ListInterventionsInputDto);
    return new ListInterventionsOutputDto([]);
  }
}
