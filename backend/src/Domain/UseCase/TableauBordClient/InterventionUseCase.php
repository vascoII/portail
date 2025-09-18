<?php

declare(strict_types=1);

namespace App\Domain\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\TableauBordClientSoapInterface;

final class InterventionUseCase implements UseCaseInterface
{
  public function __construct(private readonly TableauBordClientSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof InterventionInputDto);
    return new InterventionOutputDto([]);
  }
}
