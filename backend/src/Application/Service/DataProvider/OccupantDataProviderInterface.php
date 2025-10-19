<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface OccupantDataProviderInterface
{
  public function getOccupantReleveEauService(): SuccessOutputDto;
  public function getOccupantReleveRepartService(): SuccessOutputDto;
  public function getOccupantReleveNoteService(GetByEnergyStringInputDto $inputDto): SuccessOutputDto;
  public function getOccupantInterventionService(GetByIdIntInputDto $inputDto): SuccessOutputDto;
}
