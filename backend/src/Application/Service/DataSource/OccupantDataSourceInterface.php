<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;

interface OccupantDataSourceInterface
{

  public function fetchAlertes(AlertesInputDto $inputDto): object;
  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object;
  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object;
  public function fetchListInterventions(InterventionsInputDto $inputDto): object;
  public function fetchListLeaks(LeaksInputDto $inputDto): object;
  public function fetchMyAccount(MyAccountInputDto $inputDto): object;
  public function fetchShowEauReleve(ShowEauReleveInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchShowNoteReleve(ShowNoteReleveInputDto $inputDto): object;
  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchSimulateur(SimulateurInputDto $inputDto): object;
  public function fetchEdit(EditInputDto $inputDto): object;
}
