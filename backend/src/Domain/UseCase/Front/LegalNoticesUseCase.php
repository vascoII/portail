<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class LegalNoticesUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof LegalNoticesInputDto);
    return new LegalNoticesOutputDto('legal notices');
  }
}
