<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Input\Occupant\ListAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowUseInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;

interface OccupantSoapInterface
{

  public function alertesService(AlertesInputDto $inputDto): array;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): array;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): array;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): array;
  public function listLeaksService(ListLeaksInputDto $inputDto): array;
  public function myAccountService(MyAccountInputDto $inputDto): array;
  public function showEauReleveService(ShowEauReleveInputDto $inputDto): array;
  public function showInterventionService(ShowInterventionInputDto $inputDto): array;
  public function showNoteReleveService(ShowNoteReleveInputDto $inputDto): array;
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): array;
  public function showService(ShowUseInputDto $inputDto): array;
  public function simulateurService(SimulateurInputDto $inputDto): array;
}
