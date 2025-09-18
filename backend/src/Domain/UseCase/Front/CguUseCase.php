<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\FrontSoapInterface;

final class CguUseCase implements UseCaseInterface
{
  public function __construct(private readonly FrontSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof CguInputDto);

    return new CguOutputDto('Conditions Générales d\'Utilisation');
  }
}
