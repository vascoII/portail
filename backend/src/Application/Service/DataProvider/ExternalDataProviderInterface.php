<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto ;
use App\Application\Dto\Output\External\GetReportByTokenDataSourceOutputDto;

interface ExternalDataProviderInterface
{

  public function getReportByTokenService(GetByIdStringInputDto  $inputDto): GetReportByTokenDataSourceOutputDto;
  
}
