<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Output\Logement\CreateTicketOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class CreateTicketUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}

  public function execute(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    $serviceResponse = $this->service->createTicketService($inputDto);
    return $this->transformer->transformCreateTicketResponse($serviceResponse); 
  }
}
