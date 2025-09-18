<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;

interface TableauBordClientSoapInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto;
}
