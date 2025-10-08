<?php

declare(strict_types=1);

namespace App\Application\Service\Redis;

use App\Application\Dto\Output\Shared\SessionDto;

interface RedisServiceInterface
{
  public function storeSession(string $tokenId, SessionDto $sessionDto, int $ttl = 3600): bool;

  public function getSession(string $tokenId): ?SessionDto;

  public function deleteSession(string $sessionId): bool;

  public function storeUserData(string $key, array $data, int $ttl = 3600): bool;

  public function getUserData(string $key): ?array;
}
