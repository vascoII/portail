<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Output\Ticketing\GetAttachmentOutputDto;
use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;
use App\Application\Dto\Output\Ticketing\SetTicketStatusOutputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketInterOutputDto;
use App\Application\Dto\Output\Ticketing\GetTicketsIntersUserOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\TicketingDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\TicketingTransformerInterface;

final class TicketingDataProvider implements TicketingDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private TicketingDataSourceInterface $ticketingDataSource,
    private TicketingTransformerInterface $ticketingTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function attachmentTicketService(GetAttachmentInputDto $inputDto): GetAttachmentOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "ticketing_attachment_ticket:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetAttachmentOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->ticketingDataSource->fetchGetAttachment($inputDto);
    $dto = $this->ticketingTransformer->transformGetAttachment($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function closeTicketService(SetTicketStatusInputDto $inputDto): SetTicketStatusOutputDto
  {
    $rawData = $this->ticketingDataSource->fetchSetTicketStatus($inputDto);
    $dto = $this->ticketingTransformer->transformSetTicketStatus($rawData);

    return $dto;
  }

  public function createTicketService(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto
  {
    $rawData = $this->ticketingDataSource->fetchCreateTicketInter($inputDto);
    $dto = $this->ticketingTransformer->transformCreateTicketInter($rawData);

    return $dto;
  }

  public function ticketListService(): GetTicketsIntersUserOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "ticketing_ticket_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetTicketsIntersUserOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->ticketingDataSource->fetchGetNbTicketsIntersUser();
    $dto = $this->ticketingTransformer->transformGetTicketsIntersUser($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
