<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\DysfunctionsOutputDto;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Output\Occupant\InterventionsOutputDto;
use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Output\Occupant\LeaksOutputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Dto\Output\Occupant\EditOutputDto;

interface OccupantDataProviderInterface
{

  public function alertesService(AlertesInputDto $inputDto): AlertesOutputDto;
  public function listDysfunctionsService(DysfunctionsInputDto $inputDto): DysfunctionsOutputDto;
  public function listInterventionsService(InterventionsInputDto $inputDto): InterventionsOutputDto;
  public function listLeaksService(LeaksInputDto $inputDto): LeaksOutputDto;
  public function myAccountService(MyAccountInputDto $inputDto): MyAccountOutputDto;
  public function showEauReleveService(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function showNoteReleveService(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto;
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function simulateurService(SimulateurInputDto $inputDto): SimulateurOutputDto;
  public function editService(EditInputDto $inputDto): EditOutputDto;
}
