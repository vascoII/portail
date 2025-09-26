<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Domain\Service\DataProvider\TableauBordClientInterface;

final class TableauBordClientService implements TableauBordClient
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {

  }

  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto
  {

  }
  
}
