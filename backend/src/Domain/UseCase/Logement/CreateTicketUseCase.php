<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Output\Logement\CreateTicketOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class CreateTicketUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    return $this->serviceDataProvider->createTicketService($inputDto); 
  }
}
