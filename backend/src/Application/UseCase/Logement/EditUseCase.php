<?php

declare(strict_types=1);

namespace App\Application\UseCase\Logement;

use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class EditUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(EditInputDto $inputDto): EditOutputDto
  {
    return $this->serviceDataProvider->editService($inputDto);
  }
}
