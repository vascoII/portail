<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;
use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;

interface FrontInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function cguService(CguInputDto $inputDto): CguOutputDto;
  public function personalDatasService(PersonalDatasInputDto $inputDto): PersonalDatasOutputDto;
  public function legalNoticesService(LegalNoticesInputDto $inputDto): LegalNoticesOutputDto;
}
