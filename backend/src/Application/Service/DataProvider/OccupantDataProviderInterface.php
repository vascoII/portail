<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Input\Occupant\PatchOccupantInputDto;
use App\Application\Dto\Input\Occupant\PostOccupantInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface OccupantDataProviderInterface
{
  public function getOccupantReleveEauService(): SuccessOutputDto;
  public function getOccupantReleveRepartService(): SuccessOutputDto;
  public function getOccupantReleveNoteService(GetByEnergyStringInputDto $inputDto): SuccessOutputDto;
  public function getOccupantInterventionService(GetByIdIntInputDto $inputDto): SuccessOutputDto;
  public function patchOccupantService(PatchOccupantInputDto $inputDto): SuccessOutputDto;
  public function postOccupantService(PostOccupantInputDto $inputDto): SuccessOutputDto;

  public function listFuitesByOccupantService(): SuccessOutputDto;
}
