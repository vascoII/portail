<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\FrontSoapInterface;

final class IndexUseCase implements UseCaseInterface
{
  public function __construct(private readonly FrontSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof IndexInputDto);

    return new IndexOutputDto('home');
  }
}
