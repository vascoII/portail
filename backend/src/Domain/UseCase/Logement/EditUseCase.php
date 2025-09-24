<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class EditUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    $serviceResponse = $this->service->editService($inputDto);
    return $this->transformer->transformEditResponse($serviceResponse); 
  }
}
