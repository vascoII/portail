<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;
use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;
use App\Domain\Service\Soap\FrontSoapInterface;

final class FrontSoap implements FrontSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto('home');
  }

  public function cguService(CguInputDto $inputDto): CguOutputDto
  {
    // TODO: Implement cguService logic
    return new CguOutputDto('Conditions Générales d\'Utilisation');
  }

  public function personalDatasService(PersonalDatasInputDto $inputDto): PersonalDatasOutputDto
  {
    // TODO: Implement personalDatasService logic
    return new PersonalDatasOutputDto('personal datas');
  }

  public function legalNoticesService(LegalNoticesInputDto $inputDto): LegalNoticesOutputDto
  {
    // TODO: Implement legalNoticesService logic
    return new LegalNoticesOutputDto('legal notices');
  }
}
