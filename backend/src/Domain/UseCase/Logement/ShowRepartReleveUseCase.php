<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ShowRepartReleveUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowRepartReleveInputDto);
    return new ShowRepartReleveOutputDto($inputDto->pkImmeuble, $inputDto->pkLogement);
  }
}
