<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Output\Logement\GuideOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class GuideUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(GuideInputDto $inputDto): GuideOutputDto
  {
    $serviceResponse = $this->service->guideService($inputDto);
    return $this->transformer->transformGuideResponse($serviceResponse);
  }
}
