<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;

interface GestionParcDataSourceInterface
{

  public function fetchIndex(): object;
  public function fetchIntervention(InterventionInputDto $inputDto): object;
  public function fetchReport(ReportInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchListInterventions(InterventionsInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
  public function fetchListLeaks(LeaksInputDto $inputDto): object;
  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object;
  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object;

  public function CreateGestionnaire($inputDto): object;
  public function DeleteUser($inputDto): object;
  public function GetChildUsers($inputDto): object;
}
