<?php

declare(strict_types=1);

namespace App\Domain\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;

use App\Domain\Service\Soap\TableauBordClientSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly TableauBordClientSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->service->indexService($inputDto);
  }
}
