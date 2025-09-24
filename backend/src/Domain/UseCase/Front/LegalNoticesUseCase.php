<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;
use App\Infrastructure\Transformer\FrontTransformer;
use App\Domain\Service\Soap\FrontSoapInterface;

final class LegalNoticesUseCase
{
  public function __construct(
    private readonly FrontSoapInterface $service,
    private readonly FrontTransformer $transformer    
  ) {}

  public function execute(LegalNoticesInputDto $inputDto): LegalNoticesOutputDto
  {
    $serviceResponse = $this->service->legalNoticesService($inputDto);
    return new LegalNoticesOutputDto();
  }
}
