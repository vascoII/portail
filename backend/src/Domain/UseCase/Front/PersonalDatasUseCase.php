<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Infrastructure\Transformer\FrontTransformer;
use App\Domain\Service\Soap\FrontSoapInterface;

final class PersonalDatasUseCase
{
  public function __construct(
    private readonly FrontSoapInterface $service,
    private readonly FrontTransformer $transformer    
  ) {}

  public function execute(PersonalDatasInputDto $inputDto): PersonalDatasOutputDto
  {
    $serviceResponse = $this->service->personalDatasService($inputDto);
    return $this->transformer->transformPersonalDataResponse($serviceResponse);
  }
}
