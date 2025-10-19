<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\TicketDataProviderInterface;
use App\Application\Service\DataSource\TicketDataSourceInterface;
use App\Application\Service\Transformer\TicketTransformerInterface;

final class TicketDataProvider implements TicketDataProviderInterface
{
  public function __construct(
    private readonly TicketDataSourceInterface $dataSource,
    private readonly TicketTransformerInterface $transformer
  ) {}

  public function listTicketsService(): SuccessOutputDto
  {
    $rawData = $this->dataSource->fetchListTickets();
    return $this->transformer->transformListTickets($rawData);
  }

  public function getTicketService(GetByIdIntInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->dataSource->fetchGetTicket($inputDto);
    return $this->transformer->transformGetTicket($rawData);
  }

  public function createTicketService(GetByIdIntInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->dataSource->fetchCreateTicket($inputDto);
    return $this->transformer->transformCreateTicket($rawData);
  }

  public function patchTicketService(GetByIdIntInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->dataSource->fetchPatchTicket($inputDto);
    return $this->transformer->transformPatchTicket($rawData);
  }
}
