<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;

interface TableauBordClientDataProviderInterface
{

  public function indexService(): GetTableauBordClientOutputDto;
  public function interventionService(GetReportInputDto $inputDto): GetReportOutputDto;
}
