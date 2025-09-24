<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class GetTicketOnwerUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto
  {
    $serviceResponse = $this->service->getTicketOnwerService($inputDto);
    return $this->transformer->transformGetTicketOnwerResponse($serviceResponse); 
  }
}
