<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class EditUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    \assert($inputDto instanceof EditInputDto);
    return new EditOutputDto(true);
  }
}
