<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\FrontSoapInterface;

final class PersonalDatasUseCase implements UseCaseInterface
{
  public function __construct(private readonly FrontSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof PersonalDatasInputDto);
    return new PersonalDatasOutputDto('personal datas');
  }
}
