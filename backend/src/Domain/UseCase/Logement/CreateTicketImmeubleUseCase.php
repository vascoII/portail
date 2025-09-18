<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Output\Logement\CreateTicketImmeubleOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class CreateTicketImmeubleUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof CreateTicketImmeubleInputDto);
    return new CreateTicketImmeubleOutputDto(true);
  }
}
