<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\InterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Input\Immeuble\LeaksInputDto;
use App\Application\Dto\Input\Immeuble\DysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\AnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;

interface ImmeubleDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchReport(ReportInputDto $inputDto): object;
  public function fetchListInterventions(InterventionsInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchIntervention(InterventionInputDto $inputDto): object;
  public function fetchListLeaks(LeaksInputDto $inputDto): object;
  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object;
  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object;
  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
}
