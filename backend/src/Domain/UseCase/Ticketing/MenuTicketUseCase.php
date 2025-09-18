<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class MenuTicketUseCase implements UseCaseInterface
{
  public function __construct(private readonly TicketingSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof MenuTicketInputDto);
    return new MenuTicketOutputDto([]);
  }
}
