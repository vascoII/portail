<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Domain\Service\DataProvider\FactureInterface;

final class FactureService implements FactureInterface
{
  public function indexService(): IndexOutputDto
  {

  }
  
  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {

  }

}
