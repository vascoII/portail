<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDepannagesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;

interface ImmeubleDataProviderInterface
{

  public function indexService(): GetTableauBordClientOutputDto;
  public function showService(GetTableauBordImmeubleInputDto $inputDto): GetTableauBordImmeubleOutputDto;
  public function reportService(GetReportInputDto $inputDto): GetReportOutputDto;
  public function listInterventionsService(GetInfosDepannagesByImmeubleInputDto $inputDto): GetInfosDepannagesByImmeubleOutputDto;
  public function showInterventionService(GetInfosDepannagesByImmeubleInputDto $inputDto): GetInfosDepannagesByImmeubleOutputDto;
  public function listLeaksService(GetInfosFuitesByImmeubleInputDto $inputDto): GetInfosFuitesByImmeubleOutputDto;
  public function listDysfunctionsService(GetInfosDysfonctionnementsByImmeubleInputDto $inputDto): GetInfosDysfonctionnementsByImmeubleOutputDto;
  public function listAnomaliesService(GetInfosAnomaliesByImmeubleInputDto $inputDto): GetInfosAnomaliesByImmeubleOutputDto;

}
