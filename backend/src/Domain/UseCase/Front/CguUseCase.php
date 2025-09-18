<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;

use App\Domain\Service\Soap\FrontSoapInterface;

final class CguUseCase
{
  public function __construct(private readonly FrontSoapInterface $service) {}

  public function execute(CguInputDto $inputDto): CguOutputDto
  {
    \assert($inputDto instanceof CguInputDto);

    return new CguOutputDto('Conditions Générales d\'Utilisation');
  }
}
