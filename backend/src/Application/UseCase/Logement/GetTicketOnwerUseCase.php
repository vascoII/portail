<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class GetTicketOnwerUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto
  {
    return $this->serviceDataProvider->getTicketOnwerService($inputDto);
  }
}
