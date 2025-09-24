<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Output\Logement\CreateTicketImmeubleOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class CreateTicketImmeubleUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}

  public function execute(CreateTicketImmeubleInputDto $inputDto): CreateTicketImmeubleOutputDto
  {
    $serviceResponse = $this->service->createTicketImmeubleService($inputDto);
     return $this->transformer->transformCreateTicketImmeubleResponse($serviceResponse);
  }
}
