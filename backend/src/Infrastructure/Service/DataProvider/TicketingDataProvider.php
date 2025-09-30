<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\TicketingDataProviderInterface;
use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\TicketingDataSourceInterface;
use App\Infrastructure\Service\Cache\RedisCacheService;
use App\Infrastructure\Transformer\TicketingTransformer;

final class TicketingDataProvider implements TicketingDataProviderInterface
{
  public function __construct(
      private RedisCacheService $cache,
      private TicketingDataSourceInterface $source,
      private TicketingTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function attachmentTicketService(AttachmentTicketInputDto $inputDto): AttachmentTicketOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "ticketing_attachment_ticket:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof AttachmentTicketOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchAttachmentTicket($inputDto);
      $dto = $this->transformer->transformAttachmentTicket($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function closeTicketService(CloseTicketInputDto $inputDto): CloseTicketOutputDto
  {
      $rawData = $this->source->fetchCloseTicket($inputDto);
      $dto = $this->transformer->transformCloseTicket($rawData);

      return $dto;
  }
  
  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
      $rawData = $this->source->fetchCreateTicket($inputDto);
      $dto = $this->transformer->transformCreateTicket($rawData);

      return $dto;
  }
  
  public function menuTicketService(MenuTicketInputDto $inputDto): MenuTicketOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "ticketing_menu_ticket:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof MenuTicketOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchMenuTicket($inputDto);
      $dto = $this->transformer->transformMenuTicket($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function ticketListService(): TicketListOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "ticketing_ticket_list:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof TicketListOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchTicketList();
      $dto = $this->transformer->transformTicketList($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
}
