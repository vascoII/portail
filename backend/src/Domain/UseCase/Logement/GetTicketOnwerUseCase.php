<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\LogementSoapInterface;

final class GetTicketOnwerUseCase implements UseCaseInterface
{
  public function __construct(private readonly LogementSoapInterface $soap) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof GetTicketOnwerInputDto);
    return new GetTicketOnwerOutputDto([]);
  }
}
