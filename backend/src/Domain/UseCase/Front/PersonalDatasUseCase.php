<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Front;

use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;

use App\Domain\Service\Soap\FrontSoapInterface;

final class PersonalDatasUseCase
{
  public function __construct(private readonly FrontSoapInterface $service) {}

  public function execute(PersonalDatasInputDto $inputDto): PersonalDatasOutputDto
  {
    return $this->service->personalDatasService($inputDto);
  }
}
