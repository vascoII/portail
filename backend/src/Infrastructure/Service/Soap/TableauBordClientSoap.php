<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Domain\Service\Soap\TableauBordClientSoapInterface;

final class TableauBordClientSoap implements TableauBordClientSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto([]);
  }

  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto
  {
    // TODO: Implement interventionService logic
    return new InterventionOutputDto([]);
  }
}
