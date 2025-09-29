<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Cache;

use App\Application\Dto\Output\Security\UserDto;
use App\Application\Service\Cache\RedisServiceInterface;
use Predis\Client;

final class RedisCacheService implements RedisServiceInterface
{
  private const SESSION_PREFIX = 'session:';
  private const USER_PREFIX = 'user:';

  public function __construct(
    private readonly Client $redis
  ) {}

  public function storeSession(string $sessionId, UserDto $user, int $ttl = 3600): bool
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      $userData = $this->userToArray($user);

      $this->redis->setex($key, $ttl, json_encode($userData));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function getSession(string $sessionId): ?UserDto
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      $data = $this->redis->get($key);

      if (!$data) {
        return null;
      }

      $userData = json_decode($data, true);
      return $this->arrayToUser($userData);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function deleteSession(string $sessionId): bool
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      return $this->redis->del($key) > 0;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function storeUserData(string $key, array $data, int $ttl = 3600): bool
  {
    try {
      $fullKey = self::USER_PREFIX . $key;
      $this->redis->setex($fullKey, $ttl, json_encode($data));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function getUserData(string $key): ?array
  {
    try {
      $fullKey = self::USER_PREFIX . $key;
      $data = $this->redis->get($fullKey);

      if (!$data) {
        return null;
      }

      return json_decode($data, true);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function get(string $cacheKey)
  {

  }

  public function set(string $cacheKey, $dto)
  {

  }

}
