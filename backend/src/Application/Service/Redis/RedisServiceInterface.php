<?php

declare(strict_types=1);

namespace App\Application\Service\Redis;

use App\Application\Dto\Output\Security\UserDto;

interface RedisServiceInterface
{
  public function storeSession(string $sessionId, UserDto $user, int $ttl = 3600): bool;

  public function getSession(string $sessionId): ?UserDto;

  public function deleteSession(string $sessionId): bool;

  public function storeUserData(string $key, array $data, int $ttl = 3600): bool;

  public function getUserData(string $key): ?array;
}
