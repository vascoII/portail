<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;

use App\Domain\Service\Soap\FrontSoapInterface;

final class LegalNoticesUseCase
{
  public function __construct(private readonly FrontSoapInterface $service) {}

  public function execute(LegalNoticesInputDto $inputDto): LegalNoticesOutputDto
  {
    \assert($inputDto instanceof LegalNoticesInputDto);
    return new LegalNoticesOutputDto('legal notices');
  }
}
