<?php

declare(strict_types=1);

namespace App\Domain\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;

use App\Domain\Service\Soap\TableauBordClientSoapInterface;

final class InterventionUseCase
{
  public function __construct(private readonly TableauBordClientSoapInterface $service) {}

  public function execute(InterventionInputDto $inputDto): InterventionOutputDto
  {
    \assert($inputDto instanceof InterventionInputDto);
    return new InterventionOutputDto([]);
  }
}
