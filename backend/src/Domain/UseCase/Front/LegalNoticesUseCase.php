<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\FrontSoapInterface;

final class LegalNoticesUseCase implements UseCaseInterface
{
  public function __construct(private readonly FrontSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LegalNoticesInputDto);
    return new LegalNoticesOutputDto('legal notices');
  }
}
