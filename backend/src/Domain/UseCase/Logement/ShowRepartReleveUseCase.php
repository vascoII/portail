<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ShowRepartReleveUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    return $this->service->showRepartReleveService($inputDto);
  }
}
