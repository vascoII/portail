<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;

use App\Domain\Service\Soap\FrontSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly FrontSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    return $this->service->indexService($inputDto);
  }
}
