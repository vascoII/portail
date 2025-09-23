<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;

interface FrontSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
  public function cguService(CguInputDto $inputDto): array;
  public function personalDatasService(PersonalDatasInputDto $inputDto): array;
  public function legalNoticesService(LegalNoticesInputDto $inputDto): array;
}
