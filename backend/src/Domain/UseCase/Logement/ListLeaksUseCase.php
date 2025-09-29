<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->serviceDataProvider->listLeaksService($inputDto);
  }
}
