<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;

interface FrontDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchCgu(CguInputDto $inputDto): object;
  public function fetchPersonalDatas(PersonalDatasInputDto $inputDto): object;
  public function fetchLegalNotices(LegalNoticesInputDto $inputDto): object;
}
